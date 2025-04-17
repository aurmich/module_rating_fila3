<?php

declare(strict_types=1);

namespace Modules\Rating\Filament\Resources\RatingResource\Pages;

use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Modules\Rating\Filament\Resources\RatingResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListRatings extends XotBaseListRecords
{
    protected static string $resource = RatingResource::class;

    public function getListTableColumns(): array
    {
        return [
<<<<<<< HEAD
            'id' => TextColumn::make('id')
                ->sortable()
                ->searchable(),
            'title' => TextColumn::make('title')
                ->sortable()
                ->searchable(),
            'rule' => TextColumn::make('rule')
                ->badge(),
            'is_disabled' => IconColumn::make('is_disabled')
                ->boolean(),
            'is_readonly' => IconColumn::make('is_readonly')
=======
            TextColumn::make('id')

                ->sortable()
                ->searchable(),
            TextColumn::make('title')

                ->sortable()
                ->searchable(),
            TextColumn::make('rule')

                ->badge(),
            IconColumn::make('is_disabled')
                ->boolean(),
            IconColumn::make('is_readonly')
>>>>>>> origin/dev
                ->boolean(),
        ];

        // TextColumn::make('extra_attributes.type'),
        // TextColumn::make('extra_attributes.anno'),

        // TextColumn::make('is_readonly'),
        // TextColumn::make('is_disabled'),
        // ToggleColumn::make('is_readonly'),

        // TextColumn::make('color'),
    }

    public function getTableFilters(): array
    {
        return [
        ];
    }

    public function getTableActions(): array
    {
        return [
<<<<<<< HEAD
            'view' => ViewAction::make()
                ->label(''),
            'edit' => EditAction::make()
                ->label(''),
            'delete' => DeleteAction::make()
=======
            ViewAction::make()
                ->label(''),
            EditAction::make()
                ->label(''),
            DeleteAction::make()
>>>>>>> origin/dev
                ->label('')
                ->requiresConfirmation(),
        ];
    }

    public function getTableBulkActions(): array
    {
        return [
<<<<<<< HEAD
            'delete' => DeleteBulkAction::make(),
=======
            DeleteBulkAction::make(),
>>>>>>> origin/dev
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            // ->columns($this->getTableColumns())
            ->columns($this->layoutView->getTableColumns())
            ->contentGrid($this->layoutView->getTableContentGrid())
            ->headerActions($this->getTableHeaderActions())

            ->filters($this->getTableFilters())
            ->filtersLayout(FiltersLayout::AboveContent)
            ->persistFiltersInSession()
            ->actions($this->getTableActions())
            ->bulkActions($this->getTableBulkActions())
            ->actionsPosition(ActionsPosition::BeforeColumns)
            ->defaultSort(
                column: 'created_at',
                direction: 'DESC',
            );
    }
}
