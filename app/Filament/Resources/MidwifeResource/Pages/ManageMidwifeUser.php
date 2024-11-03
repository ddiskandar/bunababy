<?php

namespace App\Filament\Resources\MidwifeResource\Pages;

use App\Enums\UserType;
use App\Filament\Resources\MidwifeResource;
use App\Models\Midwife;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageMidwifeUser extends ManageRelatedRecords implements HasForms
{
    use InteractsWithRecord;
    use InteractsWithForms;

    protected static string $resource = MidwifeResource::class;

    protected static string $relationship = 'user';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'User';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Reset Password')
                ->icon('heroicon-m-lock-open')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading(
                    fn (Midwife $record) => 'Reset Password ' . $record->name
                )
                ->action(fn (Midwife $record) => $record->user->update(['password' => bcrypt('12345678')]))
                ->hidden(fn () => ! $this->getRecord()->user),
            Action::make('Generate Akun Login')
                ->fillForm(fn (Midwife $record): array => [
                    'email' => $record->email,
                    'name' => $record->name,
                ])
                ->form([
                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->required(),
                    Forms\Components\TextInput::make('name')
                        ->label('Name')
                        ->required(),
                ])
                ->action(function (array $data, Midwife $record) {
                    $record->user()->create([
                        'email' => $data['email'],
                        'name' => $data['name'],
                        'type' => UserType::MIDWIFE,
                        'password' => bcrypt('12345678'),
                    ]);

                    return to_route('filament.admin.resources.midwives.user', $record);
                })
                ->hidden(fn () => $this->getRecord()->user),
        ];
    }

    private function fillForm()
    {
        $this->form->fill([
            'username' => $this->getRecord()->username,
            'password' => $this->getRecord()->password,
            'email' => $this->getRecord()->user->email ?? null,
            'name' => $this->getRecord()->user->name ?? null,
        ]);
    }

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->fillForm();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                ->required()
                ->unique(
                    table: 'users',
                    column: 'email',
                    ignorable: fn () => $this->getRecord()->user,
                )
                ->validationMessages([
                    'unique' => 'Email sudah ada digunakan.',
                    'required' => 'Email wajib diisi.'
                ])
                ->maxLength(255),
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                // Tables\Actions\AssociateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DissociateAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DissociateBulkAction::make(),
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->paginated(false);
    }
}
