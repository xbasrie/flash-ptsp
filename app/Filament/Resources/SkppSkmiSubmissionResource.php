<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkppSkmiSubmissionResource\Pages;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SkppSkmiSubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationGroup = 'Layanan Kepegawaian';
    protected static ?string $navigationLabel = 'SKPP & SKMI';
    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar'; // Try an appropriate icon
    protected static ?string $slug = 'skpp-skmi-submissions';

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->where('status', 'pending')->count() ?: null;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', fn($q) => $q->where('slug', 'skpp-skmi'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Pemohon')
                    ->schema([
                        Forms\Components\TextInput::make('content.nama')->label('Nama Lengkap')->disabled(),
                        Forms\Components\TextInput::make('content.nip')->label('NIP')->disabled(),
                        Forms\Components\TextInput::make('content.no_hp')->label('No HP')->disabled(),
                        Forms\Components\TextInput::make('content.unit_kerja')->label('Unit Kerja')->disabled(),
                        Forms\Components\TextInput::make('content.jabatan')->label('Jabatan')->disabled(),
                        Forms\Components\TextInput::make('content.golongan')->label('Golongan')->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Berkas Persyaratan')
                    ->schema([
                        Forms\Components\FileUpload::make('content.files.surat_pengantar')->label('Surat Pengantar')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sptjm')->label('SPTJM')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sk_cpns_pns')->label('SK CPNS & PNS')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.sk_kp_terakhir')->label('SK KP Terakhir')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.akreditasi_prodi')->label('Akreditasi Prodi')->disk('public')->downloadable()->openable()->disabled(),
                        Forms\Components\FileUpload::make('content.files.ijazah_transkrip_legalisir')->label('Ijazah & Transkrip')->disk('public')->downloadable()->openable()->disabled(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tracking_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('content.nama')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('content.nip')->label('NIP')->searchable(),
                Tables\Columns\TextColumn::make('content.unit_kerja')->label('Unit Kerja')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Tanggal Masuk')->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'proses',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'proses' => 'Proses',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('updateStatus')
                    ->label('Update Status')
                    ->icon('heroicon-o-pencil-square')
                    ->color('warning')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'proses' => 'Proses',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('admin_note')
                            ->label('Catatan Admin')
                            ->required(),
                    ])
                    ->action(function (Submission $record, array $data): void {
                        $record->update([
                            'status' => $data['status'],
                            'admin_note' => $data['admin_note'],
                        ]);

                        \App\Models\TrackingLog::create([
                            'submission_id' => $record->id,
                            'status' => $data['status'],
                            'note' => $data['admin_note'],
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Status updated successfully')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSkppSkmiSubmissions::route('/'),
        ];
    }
}
