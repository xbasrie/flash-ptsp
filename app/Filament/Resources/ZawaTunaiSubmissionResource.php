<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZawaTunaiSubmissionResource\Pages;
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
use Illuminate\Support\HtmlString;

class ZawaTunaiSubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Wakaf Tunai';
    protected static ?string $pluralLabel = 'Wakaf Tunai';
    protected static ?string $slug = 'zawa-tunai-submissions';
    protected static ?string $navigationGroup = 'Layanan Zakat & Wakaf';
    protected static ?int $navigationSort = 803;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('service', function ($query) {
            $query->where('slug', 'zawa-tunai');
        });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Wakif')
                    ->schema([
                        Forms\Components\TextInput::make('content.nama')
                            ->label('Nama Wakif')
                            ->required(),
                        Forms\Components\TextInput::make('content.nik')
                            ->label('NIK Wakif')
                            ->required(),
                        Forms\Components\TextInput::make('content.no_hp')
                            ->label('No. Handphone')
                            ->tel()
                            ->required(),
                        Forms\Components\TextInput::make('content.email')
                            ->label('Email')
                            ->email(),
                        Forms\Components\Textarea::make('content.alamat')
                            ->label('Alamat')
                            ->columnSpanFull()
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Detail Wakaf')
                    ->schema([
                        Forms\Components\Select::make('content.profesi_wakif')
                            ->label('Berwakaf Sebagai')
                            ->options([
                                'asn' => 'ASN',
                                'pelajar' => 'Pelajar',
                                'catin' => 'Catin',
                                'jamaah_haji' => 'Jamaah Haji',
                                'lainnya' => 'Lainnya',
                            ])
                            ->required(),
                        Forms\Components\Select::make('content.sumber_dana')
                            ->label('Sumber Dana')
                            ->options([
                                'gaji' => 'Gaji',
                                'hasil_usaha' => 'Hasil Usaha',
                                'warisan' => 'Warisan',
                                'lainnya' => 'Lainnya',
                            ])
                            ->required(),
                        Forms\Components\Checkbox::make('content.ikrar')
                            ->label('Dengan ini, saya berikrar wakaf tunai kepada Nadzir BWI perwakilan Kota Surabaya untuk kesejahteraan umat, pemberdayaan ekonomi umat, bantuan fakir miskin, anak yatim, beasiswa, dan kesehatan.')
                            ->columnSpanFull()
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Pembayaran')
                    ->schema([
                        Forms\Components\Placeholder::make('info_pembayaran')
                            ->label('Informasi Pembayaran')
                            ->content(new HtmlString('
                                <div class="space-y-4">
                                    <div class="text-center">
                                        <p class="font-bold text-lg mb-2">Scan QRIS</p>
                                        <img src="/assets/images/qris_nazhir.png" alt="QRIS Nadzir" class="max-w-xs mx-auto border rounded-lg shadow p-2">
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg border">
                                        <p class="font-medium">Atau transfer melalui rekening:</p>
                                        <div class="mt-2">
                                            <p class="font-bold text-lg">Nadzir BWI Surabaya 1</p>
                                            <p>No Rek: <span class="font-mono font-bold text-primary-600">7297299616</span></p>
                                            <p>BANK BSI</p>
                                        </div>
                                    </div>
                                </div>
                            '))
                            ->columnSpanFull(),
                        FileUpload::make('content.files.bukti_transfer')
                            ->label('Bukti Transfer')
                            ->disk('public')
                            ->required()
                            ->columnSpanFull()
                            ->downloadable()
                            ->openable(),
                    ]),
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
                    ->label('Nama Wakif')
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
                    ])
                    ->action(function (Submission $record, array $data) {
                        $record->update([
                            'status' => $data['status'],
                            'admin_note' => $data['note'] ?? null,
                        ]);
                        
                        TrackingLog::create([
                            'submission_id' => $record->id,
                            'status' => $data['status'],
                            'note' => $data['note'] ?? 'Status diperbarui oleh admin',
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
            ->bulkActions([
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
            'index' => Pages\ListZawaTunaiSubmissions::route('/'),
            'create' => Pages\CreateZawaTunaiSubmission::route('/create'),
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

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(['super admin', 'admin zawa']);
    }

    public static function canCreate(): bool
    {
        return true;
    }
}
