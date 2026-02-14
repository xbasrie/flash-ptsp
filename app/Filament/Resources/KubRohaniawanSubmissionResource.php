<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KubRohaniawanSubmissionResource\Pages;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use App\Models\TrackingLog;
use Filament\Forms\Components\FileUpload;

class KubRohaniawanSubmissionResource extends Resource
{
    use \App\Filament\Traits\HasPermissionAccess;

    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Rekomendasi Rohaniawan Asing';
    protected static ?string $pluralLabel = 'Rekomendasi Rohaniawan Asing';
    protected static ?string $slug = 'kub-rohaniawan-submissions';
    protected static ?string $navigationGroup = 'Layanan KUB';
    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', function ($query) {
            $query->where('slug', 'kub-rohaniawan');
        });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pemohon')
                    ->schema([
                        Forms\Components\TextInput::make('content.nama')
                            ->label('Nama Pemohon')
                            ->disabled(),
                        Forms\Components\TextInput::make('content.no_hp')
                            ->label('No. Handphone')
                            ->disabled(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Berkas Persyaratan')
                    ->schema([
                        FileUpload::make('content.files.paspor')
                            ->label('Paspor')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.visa')
                            ->label('Visa')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.surat_penjamin')
                            ->label('Surat Penjamin')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                        FileUpload::make('content.files.proposal_lembaga')
                            ->label('Proposal Lembaga')
                            ->disk('public')
                            ->disabled()
                            ->downloadable()
                            ->openable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->timezone('Asia/Jakarta')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tracking_code')
                    ->label('Kode Tracking')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content.nama')
                    ->label('Nama Pemohon')
                    ->searchable(),
                 Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'process', 'proses' => 'info',
                        'approved', 'selesai' => 'success',
                        'rejected', 'ditolak' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Menunggu',
                        'process' => 'Proses',
                        'approved' => 'Selesai',
                        'rejected' => 'Ditolak',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Action::make('updateStatus')
                    ->label('Ubah Status')
                    ->icon('heroicon-o-pencil-square')
                    ->color('warning')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Menunggu',
                                'process' => 'Proses',
                                'approved' => 'Selesai',
                                'rejected' => 'Ditolak',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('note')
                            ->label('Catatan')
                            ->rows(3),
                        Forms\Components\FileUpload::make('attachment')
                            ->label('Lampiran')
                            ->disk('public')
                            ->directory('attachments')
                            ->downloadable()
                            ->openable(),
                    ])
                    ->action(function (Submission $record, array $data) {
                        $record->update([
                            'status' => $data['status'],
                            'admin_note' => $data['note'] ?? null,
                            'attachment' => $data['attachment'] ?? null,
                        ]);
                        
                        TrackingLog::create([
                            'submission_id' => $record->id,
                            'status' => $data['status'],
                            'note' => $data['note'] ?? 'Status diperbarui oleh admin',
                            'attachment' => $data['attachment'] ?? null,
                        ]);

                        \App\Services\ActivityLogger::log(
                            'updated',
                            'Memperbarui status permohonan ke ' . $data['status'] . ': ' . $record->tracking_code,
                            $record
                        );

                        \Filament\Notifications\Notification::make()
                            ->title('Status berhasil diperbarui')
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListKubRohaniawanSubmissions::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }


    public static function canCreate(): bool
    {
        return false;
    }
}
