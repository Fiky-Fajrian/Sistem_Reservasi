<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingController extends Controller
{
    /**
     * Batasan harga pada pencarian.
     *
     * @return array<string, array{label: string, min: int, max: ?int}>
     */
    public static function priceOptions(): array
    {
        return [
            'semua' => ['label' => 'Semua harga', 'min' => 0, 'max' => null],
            '0-600' => ['label' => 'Hingga Rp 600rb', 'min' => 0, 'max' => 600000],
            '600-1000' => ['label' => 'Rp 600rb - Rp 1jt', 'min' => 600000, 'max' => 1000000],
            '1000-999999' => ['label' => 'Di atas Rp 1jt', 'min' => 1000000, 'max' => null],
        ];
    }

    /**
     * Halaman utama: daftar kos populer + pencarian.
     */
    public function index(Request $request): View
    {
        $query = Kos::query();

        if (filled($request->query('q'))) {
            $query->where('nama_kos', 'like', '%'.$request->query('q').'%');
        }

        if (filled($request->query('lokasi')) && $request->query('lokasi') !== 'semua') {
            $query->where('lokasi', $request->query('lokasi'));
        }

        $priceKey = $request->query('harga', 'semua');
        $priceOption = static::priceOptions()[$priceKey] ?? null;

        if ($priceOption !== null) {
            $query->where('harga', '>=', $priceOption['min']);
            $query->when($priceOption['max'] !== null, fn ($q) => $q->where('harga', '<=', $priceOption['max']));
        }

        return view('landing', [
            'kosList' => $query->orderBy('nama_kos')->get(),
            'locations' => Kos::query()->distinct()->orderBy('lokasi')->pluck('lokasi'),
            'priceOptions' => static::priceOptions(),
            'filters' => [
                'q' => (string) $request->query('q', ''),
                'lokasi' => (string) $request->query('lokasi', 'semua'),
                'harga' => $priceKey,
            ],
            'sections' => ['populer', 'tentang'],
        ]);
    }
}
