<?php

namespace App\Filament\Widgets;

use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

use App\Models\Event;
use App\Filament\Resources\EventResource;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

class CalendarWidget extends FullCalendarWidget
{

    public Model | string | null $model = Event::class;

    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('title'),

            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\TextInput::make('description'),
                    Forms\Components\Select::make('priority')
                        ->options([
                            '0' => 'Low',
                            '1' => 'Medium',
                            '2' => 'High',
                            '3' => 'Urgent',
                        ]),
                    Forms\Components\DateTimePicker::make('start_date'),
                    Forms\Components\DateTimePicker::make('end_date'),
                ]),
        ];
    }

    public function fetchEvents(array $fetchInfo): array
    {
        return Event::query()
            ->where('start_date', '>=', $fetchInfo['start'])
            ->where('end_date', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn(Event $event) => [
                    'title' => $event->title,
                    'start' => $event->start_date,
                    'end' => $event->end_date,
                    'url' => EventResource::getUrl(name: 'edit', parameters: ['record' => $event]),
                    'shouldOpenUrlInNewTab' => true
                ]
            )
            ->all();
    }
}