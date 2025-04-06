<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data)
    {
        try {
            // Начинаем транзакцию
            DB::beginTransaction();

            // Проверяем наличие тегов и убираем их из данных
            if (isset($data['tag_ids'])) {
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            }

            // Загружаем изображения
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);

            // Создаём пост
            $post = Post::create($data); // Используем create вместо firstOrCreate

            // Привязываем теги, если они есть
            if (isset($tagIds)) {
                $post->tags()->attach($tagIds);
            }

            // Завершаем транзакцию
            DB::commit();

        } catch (\Exception $exception) {
            // В случае ошибки откатываем транзакцию
            DB::rollBack();
            abort(500);
        }
    }

    public function update($data, $post)
    {
        try {
            DB::beginTransaction();

            // Проверяем наличие тегов и убираем их из данных
            if (isset($data['tag_ids'])) {
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            }

            // Загружаем изображения, если они есть
            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }
            if (isset($data['main_image'])) {
                $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            }

            // Обновляем пост
            $post->update($data);

            // Привязываем теги, если они есть
            if (isset($tagIds)) {
                $post->tags()->sync($tagIds);
            }

            // Завершаем транзакцию
            DB::commit();

        } catch (\Exception $exception) {
            // В случае ошибки откатываем транзакцию
            DB::rollBack();
            abort(500);
        }
        return $post;
    }
}
