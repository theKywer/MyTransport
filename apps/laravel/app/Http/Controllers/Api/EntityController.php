<?php

namespace App\Http\Controllers\Api;

use stdClass;
use App\Http\Controllers\Controller;
use App\Interfaces\ServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Базовый контроллер для управления сущностью.
 * Представлены базовые методы:
 * - {@see EntityController::create()}
 * - {@see EntityController::update()}
 * - {@see EntityController::get()}
 * - {@see EntityController::delete()}
 */
abstract class EntityController extends Controller 
{
    Use ValidatesRequests;

    /**
     * Возвращает экземпляр сервиса
     *
     * @return ServiceInterface
     */
    abstract protected function service(): ServiceInterface;

    /**
     * Возвращаем экзепляр валидатора
     *
     * @return string
     */
    abstract protected function formRequestForCreate(): string;

    /**
     * Возвращаем экзепляр валидатора
     *
     * @return string
     */
    abstract protected function formRequestForUpdate(): string;

    /**
     * Возвращаем экзепляр валидатора
     *
     * @return string
     */
    abstract protected function formRequestForGet(): string;
    
    /**
     * Возвращаем экзепляр валидатора
     *
     * @return string
     */    
    abstract protected function formRequestForDelete(): string;

    /**
     * Возвращаем массив сообщений
     *
     * @return array
     */
    abstract protected function messages(): stdClass;

    /**
     * Создание сущности
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $formRequest = app($this->formRequestForCreate());
        $validated = $formRequest->validated();
        $model = $this->service->create($validated);

        return response()->json([
            'message' => $this->messages()->created,
            'data' => $model
        ], 201);
    }

    /**
     * Обновление сущности
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $formRequest = app($this->formRequestForUpdate());
        $validated = $formRequest->validated();
        $model = $this->service->update($validated);

        return response()->json([
            'message' => $this->messages()->updated,
            'data' => $model
        ]);
    }

    /**
     * Получение одной сущности
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function get(Request $request): JsonResponse
    {
        $formRequest = app($this->formRequestForGet());
        $validated = $formRequest->validated();
        $model = $this->service->get($validated);

        return response()->json([
            'message' => $this->messages()->get,
            'data' => $model
        ]);
    }

    /**
     * Удаление сущности
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        $this->service->delete($id);

        return response()->noContent();
    }

}
