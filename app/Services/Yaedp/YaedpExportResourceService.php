<?php

namespace App\Services\Yaedp;

use App\Models\Yaedp\ExportResources\ExportResource;
use App\Models\Yaedp\ExportResources\ExportResourceCategory;
use Illuminate\Support\Str;

/**
 * Class YaedpExportResourceService.
 */
class YaedpExportResourceService
{
    public function exportResourceCategory(){
        return new ExportResourceCategory();
    }

    public function exportResourceCategoryRelations(){
        return $this->exportResourceCategory()->with('export_resource');
    }

    public function exportResourceCategoryById($id){
        return $this->exportResourceCategoryRelations()->findOrFail($id);
    }

    public function exportResource(){
        return new ExportResource();
    }

    public function exportResourceRelations(){
        return $this->exportResource()->with('category', 'locations', 'services');
    }

    public function exportResourceById($id): \Illuminate\Database\Eloquent\Builder
    {
        return $this->exportResourceRelations()->findOrFail($id);
    }

    public function exportResourceByCategoryId($categoryId): \Illuminate\Database\Eloquent\Builder
    {
        return $this->exportResourceRelations()
            ->where('export_resource_category_id', $categoryId);
    }

    public function storeCategory($request): array
    {
        $input = $request->all();
        $input['slug'] = Str::slug($input['name']);
        $data = $this->exportResourceCategory()->create($input);
        return [
            'success' => true,
            'category' => $data,
        ];
    }

    public function updateCategory($request, $id): array
    {
        $input = $request->all();
        $category = $this->exportResourceCategoryById($id);
        $category->update($input);
        return [
            'success' => true,
            'category' => $category,
        ];
    }

    public function storeExportResource($request): array
    {
        $input = $request->all();
        $data = $this->exportResource()->create($input);

        return [
            'success' => true,
            'resource' => $data,
        ];
    }

}
