<?php

namespace App\Filament\Admin\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Models\Activity;

class AktivitasTerbaru extends BaseWidget
{
    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => Activity::query()
                    ->with('causer')
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('causer.name')
                    ->label('User')
                    ->icon('heroicon-m-user')
                    ->placeholder('-'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi Aktivitas')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->description(fn ($record): string => $record->created_at->diffForHumans())
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
