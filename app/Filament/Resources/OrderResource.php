<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Enums\PlaceType;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Address;
use App\Models\Family;
use App\Models\Kecamatan;
use App\Models\Midwife;
use App\Models\Order;
use App\Models\Place;
use App\Models\Price;
use App\Models\Room;
use App\Models\Slot;
use App\Models\Treatment;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Admin';

    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Customer')
                            ->collapsible()
                            ->schema(static::getDetailsFormSchema()),
                        Forms\Components\Section::make('Skrininig')
                            ->heading('Skrininig')
                            ->collapsed()
                            ->schema([
                                static::getScreeningRepeater()
                            ]),
                        Forms\Components\Section::make('Waktu dan Tempat')
                            ->collapsed()
                            ->schema(static::getPlaceFormSchema()),
                        Forms\Components\Section::make('Items')
                            ->heading('Treatment')
                            ->collapsed()
                            ->schema([
                                static::getItemsRepeater()
                            ]),
                        Forms\Components\Section::make('Report')
                            ->heading('Report Bidan')
                            ->collapsed()
                            ->schema([
                                static::getReportRepeater()
                            ]),
                        Forms\Components\Section::make('Adjustment')
                            ->collapsed()
                            ->schema([
                                Forms\Components\TextInput::make('adjustment_amount')
                                    ->numeric(),
                                Forms\Components\Textarea::make('adjustment_name'),
                                Forms\Components\TextInput::make('transport')
                                    ->numeric(),
                            ]),
                        ])
                        ->columnSpan(['lg' => fn (?Order $record) => $record === null ? 3 : 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Summary')
                            ->collapsible()
                            ->schema([
                                Forms\Components\Placeholder::make('placeholder.midwife.name')
                                    ->label('Bidan')
                                    ->content(fn (Order $record): ?string => $record->midwife->name),
                                Forms\Components\Placeholder::make('placeholder.place.name')
                                    ->label('Tempat')
                                    ->content(fn (Order $record): ?string => $record->place->name),
                                Forms\Components\Placeholder::make('placeholder.place.room.name')
                                    ->hidden(fn (Order $record) => $record->place->type === PlaceType::HOMECARE)
                                    ->label('Ruangan')
                                    ->content(fn (Order $record): ?string => $record->room->name ?? ''),
                                Forms\Components\Placeholder::make('placeholder.time')
                                    ->label('Waktu')
                                    ->content(fn (Order $record): ?string => $record->getLongDateTime()),
                                Forms\Components\Placeholder::make('placeholder.customer.name')
                                    ->label('Customer')
                                    ->content(fn (Order $record): ?string => $record->customer->name),
                                Forms\Components\Placeholder::make('placeholder.address.full')
                                    ->hidden(fn (Order $record) => $record->place->type === PlaceType::CLINIC)
                                    ->label('Alamat')
                                    ->content(fn (Order $record): ?string => $record->address->fullAddress  . ' (' . $record->address->kecamatan->distance . ' km)'),
                                Forms\Components\Placeholder::make('placeholder.treatments')
                                    ->label('Treatment')
                                    ->content(fn (Order $record): ?string => $record->listTreatments),
                                Forms\Components\Placeholder::make('placeholder.customer.phone')
                                    ->label('Phone')
                                    ->content(fn (Order $record): ?string => $record->customer->phone),
                            ]),

                        Forms\Components\Section::make('Layanan')
                            ->collapsed()
                            ->schema([
                                Forms\Components\Placeholder::make('placeholder.service.finished_at')
                                    ->label('Selesai Treatment')
                                    // ->hidden(fn (Order $record) => $record->status->value <= OrderStatus::FINISHED->value)
                                    ->content(fn (Order $record): ?string => $record->finished_at?->format('d M Y H:i') ?? '-'),
                            ]),


                        Forms\Components\Section::make('Pembayaran')
                            ->collapsed()
                            ->schema([
                                Forms\Components\Placeholder::make('placeholder.payment.treatment')
                                    ->label('Total Treatment')
                                    ->content(fn (Order $record): ?string => \App\Support\FormatCurrency::rupiah($record->total_price)),
                                Forms\Components\Placeholder::make('placeholder.payment.transport')
                                    ->label('Transport')
                                    ->content(fn (Order $record): ?string => \App\Support\FormatCurrency::rupiah($record->transport)),
                                Forms\Components\Placeholder::make('placeholder.payment.grand_total')
                                    ->label('Total Tagihan')
                                    ->content(fn (Order $record): ?string => \App\Support\FormatCurrency::rupiah($record->getGrandTotal())),
                                Forms\Components\Placeholder::make('placeholder.payment.verified')
                                    ->label('Total Pembayaran')
                                    ->content(fn (Order $record): ?string => \App\Support\FormatCurrency::rupiah($record->getVerifiedPayments())),
                                Forms\Components\Placeholder::make('placeholder.payment.remaining')
                                    ->label('Sisa Pembayaran')
                                    ->content(fn (Order $record): ?string => \App\Support\FormatCurrency::rupiah($record->getRemainingPayment())),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Order $record) => $record === null),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->date('D, d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time'),
                Tables\Columns\TextColumn::make('end_time'),
                Tables\Columns\TextColumn::make('place.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('midwife.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('transport')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('adjustment_amount')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PaymentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getDetailsFormSchema(): array
    {
        return [
            Forms\Components\ToggleButtons::make('status')
                ->required()
                ->options(OrderStatus::class)
                ->inline()
                ->columnSpanFull()
                ->hiddenOn('create'),
            Forms\Components\Select::make('customer_id')
                ->relationship('customer', 'name')
                ->live()
                ->preload()
                ->searchable()
                ->required()
                ->columnSpanFull()
                ->afterStateUpdated(fn (Set $set) => $set('address_id', null))
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('dob')
                        ->label('Tanggal Lahir'),
                    Forms\Components\TextInput::make('phone')
                        ->tel()
                        ->maxLength(255),
                ])
                ,
            Forms\Components\Select::make('address_id')
                ->label('Alamat')
                ->relationship(
                    'address',
                    'label',
                    fn (Builder $query, Get $get) => $query->where('customer_id', $get('customer_id'))
                )
                ->getOptionLabelFromRecordUsing(fn (Address $record) => "{$record->label} {$record->fullAddress}")
                ->hidden(fn (Get $get) => !$get('customer_id'))
                ->columnSpanFull()
                ->reactive()
                ->searchable()
                ->required()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('label')
                        ->placeholder('ex: Rumah')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('address')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('desa')
                        ->label('Desa/Kelurahan')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('kecamatan_id')
                        ->label('Kecamatan')
                        ->options(Kecamatan::pluck('name', 'id')->toArray())
                        ->required()
                        ->searchable()
                        ->preload(),
                ])
                ->createOptionUsing(function (array $data, Get $get) {
                    Address::create([
                        'customer_id' => $get('customer_id'),
                        'label' => $data['label'],
                        'address' => $data['address'],
                        'desa' => $data['desa'],
                        'kecamatan_id' => $data['kecamatan_id'],
                    ]);
                }),
        ];
    }

    public static function getScreeningRepeater(): Repeater
    {
        return Repeater::make('screening')
            ->schema([
                Forms\Components\Textarea::make('keluhan')
                    ->label('Keluhan')
                    ->required(),
                Forms\Components\ToggleButtons::make('penyakit_menular')
                    ->label('Penyakit Menular')
                    ->boolean()
                    ->inline()
                    ->required(),
                Forms\Components\ToggleButtons::make('riwayat_imunisasi')
                    ->label('Riwayat Imunisasi')
                    ->boolean()
                    ->inline()
                    ->required(),
            ])
            ->addable(false)
            ->deletable(false)
            ->reorderable(false);
    }

    public static function getReportRepeater(): Repeater
    {
        return Repeater::make('report')
            ->schema([
                Forms\Components\ToggleButtons::make('payment')
                    ->label('Payment')
                    ->options(['Transfer', 'Cash'])
                    ->inline()
                    ->required(),
                Forms\Components\ToggleButtons::make('treatments_match')
                    ->label('Treatments')
                    ->boolean('Sesuai', 'Ada Perubahan')
                    ->inline()
                    ->live()
                    ->required(),
                Forms\Components\Textarea::make('treatments_changed')
                    ->label('Perubahan Treatments')
                    ->required()
                    ->reactive()
                    ->hidden(fn (Get $get) => $get('treatments_match')),

                Forms\Components\ToggleButtons::make('repeat')
                    ->boolean()
                    ->label('Repeat')
                    ->inline()
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set) {
                        $set('repeat_count', 0);
                        $set('repeat_date_1', null);
                        $set('repeat_date_2', null);
                        $set('repeat_date_3', null);
                        $set('repeat_date_4', null);
                        $set('repeat_date_5', null);
                    })
                    ->required(),
                Forms\Components\TextInput::make('repeat_count')
                    ->label('Jumlah Repeat')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->reactive()
                    ->hidden(fn (Get $get) => !$get('repeat'))
                    ->required(),
                Forms\Components\DatePicker::make('repeat_date_1')
                    ->label('Tanggal Repeat 1')
                    ->required()
                    ->reactive()
                    ->visible(fn (Get $get) => $get('repeat_count') >= 1),
                Forms\Components\DatePicker::make('repeat_date_2')
                    ->label('Tanggal Repeat 2')
                    ->required()
                    ->reactive()
                    ->visible(fn (Get $get) => $get('repeat_count') >= 2),
                Forms\Components\DatePicker::make('repeat_date_3')
                    ->label('Tanggal Repeat 3')
                    ->required()
                    ->reactive()
                    ->visible(fn (Get $get) => $get('repeat_count') >= 3),
                Forms\Components\DatePicker::make('repeat_date_4')
                    ->label('Tanggal Repeat 4')
                    ->required()
                    ->reactive()
                    ->visible(fn (Get $get) => $get('repeat_count') >= 4),
                Forms\Components\DatePicker::make('repeat_date_5')
                    ->label('Tanggal Repeat 5')
                    ->required()
                    ->reactive()
                    ->visible(fn (Get $get) => $get('repeat_count') >= 5),

                Forms\Components\ToggleButtons::make('up_selling')
                    ->label('Up Selling')
                    ->boolean()
                    ->inline()
                    ->required(),
                Forms\Components\ToggleButtons::make('cross_selling')
                    ->label('Cross Selling')
                    ->boolean()
                    ->inline()
                    ->live()
                    ->required(),
                Forms\Components\TextInput::make('cross_selling_amount')
                    ->label('Jumlah Jual')
                    ->numeric()
                    ->minValue(0)
                    ->hidden(fn (Get $get) => !$get('cross_selling'))
                    ->required(),
            ])
            ->maxItems(1)
            ->defaultItems(1)
            ->deletable(false)
            // ->disabledOn('edit')
            ->reorderable(false);
    }

    public static function getPlaceFormSchema(): array
    {
        return [
            Forms\Components\ToggleButtons::make('place_id')
                ->label('Tempat')
                ->options(Place::pluck('name', 'id')->toArray())
                ->inline()
                ->required()
                ->live()
                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                    $place = Place::find($state);
                    $set('place_type', $place?->type);
                    $set(
                        'end_time',
                        Order::getCalculatedEndTime($get('date'), $get('start_time'), $get('treatments'), $place?->type)
                    );
                    $set('room_id', null);
                    $set('midwife_id', null);
                })
                ->columnSpanFull(),
            Forms\Components\ToggleButtons::make('room_id')
                ->label('Ruangan')
                ->options(fn (Get $get) => Room::where('place_id', $get('place_id'))->pluck('name', 'id')->toArray())
                ->inline()
                ->required()
                ->reactive()
                ->hidden(function (Get $get){
                    if (!$get('place_id')) {
                        return true;
                    }
                    $place = Place::find($get('place_id'));
                    return $place?->type === PlaceType::HOMECARE;
                })
                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                    $set('midwife_id', null);
                })
                ->columnSpanFull(),
            Forms\Components\ToggleButtons::make('midwife_id')
                ->label('Bidan')
                ->options(function (Get $get) {
                    $address = Address::find($get('address_id'));
                    return Midwife::query()
                        ->when($get('place_type') === PlaceType::HOMECARE,
                            fn ($query) => $query->whereHas(
                                'kecamatans',
                                fn ($query) => $query
                                    // ->select('kecamatans.*')
                                    ->where('kecamatans.id', $address->kecamatan_id)
                            )
                        )
                        // ->select('midwives.id', 'midwives.name')
                        ->pluck('name', 'id')
                        ->toArray();
                })
                ->inline()
                ->required()
                ->live()
                ->columnSpanFull(),
            Forms\Components\DatePicker::make('date')
                ->minDate(now())
                ->native(false)
                ->disabledDates([today()->addDays(5)])
                ->required()
                ->columnSpanFull(),
            Forms\Components\TimePicker::make('start_time')
                ->label('Waktu Mulai')
                ->datalist(fn (Get $get) => Slot::where('place_id', $get('place_id'))->pluck('time')->toArray())
                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                    Log::info($get('place_type')->value);
                    $set(
                        'end_time',
                        Order::getCalculatedEndTime($get('date'), $state, $get('treatments'), $get('place_type'))
                    );
                })
                ->live()
                ->required()
                ->columnSpanFull(),
            Forms\Components\TimePicker::make('end_time')
                ->label('Waktu Akhir')
                ->disabled()
                ->reactive()
                ->required()
                ->hiddenOn('create')
                ,
        ];
    }

    public static function getItemsRepeater(): Repeater
    {
        return Repeater::make('treatments')
            ->schema([
                Forms\Components\Select::make('treatment_id')
                    ->label('Treatment')
                    // ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                    // ->options(Treatment::pluck('name', 'id')->toArray())
                    ->options(function (Get $get) {
                        if ($get('../../place_type') === PlaceType::HOMECARE) {
                            $midwife = Midwife::find($get('../../midwife_id'));
                            if (!$midwife) {
                                return [];
                            }
                            return  $midwife->treatments->pluck('name', 'id')->toArray();
                        }

                        $room = Room::find($get('../../room_id'));

                        if (!$room) {
                            return [];
                        }
                        return $room?->treatments->pluck('name', 'id')->toArray();
                    })
                    ->preload()
                    ->reactive()
                    ->searchable()
                    ->required()
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        $treatment = Treatment::find($state);

                        $price = Price::where('treatment_id', $state)
                            ->where('place_id', $get('../../place_id'))
                            ->first()?->amount ?? 0;

                        $set('treatment_id', $treatment?->id);
                        $set('treatment_name', $treatment?->name);
                        $set('treatment_duration', $treatment?->duration);
                        $set('treatment_price', $price);
                        // $set('display_treatment_duration', $treatment?->duration);
                        // $set('display_treatment_price', $price);
                        $set(
                            '../../end_time',
                            Order::getCalculatedEndTime(
                                $get('../../date'),
                                $get('../../start_time'),
                                $get('../../treatments'),
                                $get('../../place_type')
                            )
                        );
                    }),
                Forms\Components\Select::make('family_id')
                    ->label('Pasien')
                    ->options(function (Get $get) {
                        return $get('../../customer_id') ? Family::where('customer_id', $get('../../customer_id'))->pluck('name', 'id')->toArray() : [];
                    })
                    ->afterStateUpdated(function ($state, Set $set) {
                        $family = Family::find($state);
                        $set('family_id', $family?->id);
                        $set('family_name', $family?->name);
                        $set('family_dob', $family?->dob);
                    })
                    ->reactive()
                    ->preload()
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('treatment_price')
                    ->label('Harga')
                    ->prefix('Rp')
                    ->disabled()
                    ->numeric()
                    ->dehydrated()
                    ->reactive()
                    ->required()
                    ,
                Forms\Components\TextInput::make('treatment_duration')
                    ->label('Durasi')
                    ->suffix(' menit')
                    ->disabled()
                    ->numeric()
                    ->dehydrated()
                    ->reactive()
                    ->required()
                    ,
            ])
            ->afterStateUpdated(function (Set $set, Get $get) {
                $set(
                    'end_time',
                    Order::getCalculatedEndTime($get('date'), $get('start_time'), $get('treatments'), $get('place_type'))
                );
            })
            ->columns(2)
            ->defaultItems(1)
            ->required();
    }

    public static function getDatetimeFormSchema(): array
    {
        return [
            Forms\Components\DatePicker::make('date')
                ->minDate(now())
                ->native(false)
                ->disabledDates([today()->addDays(5)])
                // ->required()
                ->columnSpanFull(),
            Forms\Components\TimePicker::make('start_time')
                ->datalist(fn (Get $get) => Slot::where('place_id', $get('place_id'))->pluck('time')->toArray())
                ->columnSpanFull(),
        ];
    }
}
