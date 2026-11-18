<x-layouts.landing title="Reservasi — KosKu">
    <main class="lp-section lp-reservasi">
        <div class="lp-container">
            <div class="lp-section-head">
                <div>
                    <h2>Ajukan Reservasi</h2>
                    <p>Reservasi hanya terbuka untuk akun penyewa yang sudah login — kamu aman di sini. 🎉</p>
                </div>
            </div>

            <div class="lp-reservasi-grid">
                <form class="lp-panel" method="POST" action="{{ route('reservasi.store') }}" novalidate>
                    @csrf
                    @if ($errors->any())
                        <div class="lp-alert lp-alert--error" role="alert">
                            <strong>Periksa kembali isianmu.</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="lp-form-field">
                        <label for="kos">Pilih kos</label>
                        <select id="kos" name="id_kos" required>
                            <option value="">— Pilih kos —</option>
                            @foreach ($kosList as $kos)
                                <option value="{{ $kos->id }}" @selected(old('id_kos', $preselectedKosId) == $kos->id)>
                                    {{ $kos->nama_kos }} — {{ $kos->lokasi }} (Rp {{ number_format($kos->harga, 0, ',', '.') }}/bln)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="lp-form-row">
                        <div class="lp-form-field">
                            <label for="tanggal_mulai">Tanggal mulai</label>
                            <input id="tanggal_mulai" type="date" name="tanggal_mulai"
                                   value="{{ old('tanggal_mulai') }}" min="{{ now()->toDateString() }}" required>
                        </div>
                        <div class="lp-form-field">
                            <label for="durasi_bulan">Durasi sewa</label>
                            <select id="durasi_bulan" name="durasi_bulan" required>
                                @foreach ([1 => '1 bulan', 3 => '3 bulan', 6 => '6 bulan', 12 => '12 bulan'] as $durasi => $label)
                                    <option value="{{ $durasi }}" @selected(old('durasi_bulan') == $durasi)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="lp-form-field">
                        <label for="nomor_kamar">Nomor kamar</label>
                        <input id="nomor_kamar" type="text" name="nomor_kamar" placeholder="cth: A-01"
                               value="{{ old('nomor_kamar') }}" required>
                        <small class="lp-form-hint">Isi sesuai nomor kamar yang ditawarkan pemilik kos.</small>
                    </div>

                    <button type="submit" class="lp-btn lp-btn--primary lp-btn--block">Kirim Reservasi</button>
                </form>

                <aside class="lp-panel lp-panel--muted">
                    <h3>Ringkasan reservasimu</h3>
                    @if ($reservasiList->isEmpty())
                        <p class="lp-reservasi-empty">
                            Belum ada reservasi. Ajukan yang pertama lewat form di samping —
                            klik tombol <strong>Detail</strong> pada kos favoritmu juga bisa kok!
                        </p>
                    @else
                        <ul class="lp-reservasi-list">
                            @foreach ($reservasiList as $reservasi)
                                <li>
                                    <div>
                                        <strong>{{ $reservasi->kos->nama_kos ?? 'Kos terhapus' }}</strong>
                                        <span>Kamar {{ $reservasi->nomor_kamar }} · mulai {{ \Illuminate\Support\Carbon::parse($reservasi->tanggal_mulai)->translatedFormat('d M Y') }}</span>
                                    </div>
                                    <span class="lp-badge lp-badge--pending">{{ $reservasi->durasi_bulan }} bln</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div style="margin-top: 24px; padding-top: 18px; border-top: 1px dashed #cbd5e1;">
                        <h4 style="font-size: 13.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">🛠 Butuh Bantuan / Ada Kerusakan?</h4>
                        <p style="font-size: 12px; color: #64748b; margin-bottom: 12px;">Penyewa dapat melaporkan kendala kamar atau fasilitas langsung ke pengelola.</p>
                        <button type="button" class="lp-btn lp-btn--ghost lp-btn--block" onclick="document.getElementById('resvComplaintModal').removeAttribute('hidden')" style="font-size: 12.5px;">
                            💬 Kirim Chat & Keluhan
                        </button>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    {{-- Modal Keluhan di Halaman Reservasi --}}
    <div class="lp-modal" id="resvComplaintModal" role="dialog" aria-modal="true" aria-labelledby="resvComplaintTitle" hidden>
        <div class="lp-modal-backdrop" onclick="document.getElementById('resvComplaintModal').setAttribute('hidden', '')"></div>
        <div class="lp-modal-panel" style="max-width: 480px; text-align: left;">
            <button type="button" class="lp-modal-close" onclick="document.getElementById('resvComplaintModal').setAttribute('hidden', '')" aria-label="Tutup dialog">×</button>
            <h3 id="resvComplaintTitle" style="margin-bottom: 4px; font-size: 18px; font-weight: 700;">💬 Kirim Keluhan ke Pengelola</h3>
            <p style="font-size: 13px; color: #64748b; margin-bottom: 16px;">Sampaikan kendala fasilitas kamar atau pertanyaan ke pengelola kos.</p>

            <form action="{{ route('keluhan.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; margin-bottom: 4px;">Pilih Kos</label>
                    <select name="kos_id" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                        @foreach($kosList as $k)
                            <option value="{{ $k->id }}" @selected(old('kos_id', $preselectedKosId) == $k->id)>{{ $k->nama_kos }} ({{ $k->lokasi }})</option>
                        @endforeach
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 600; margin-bottom: 4px;">Nomor Kamar</label>
                        <input type="text" name="nomor_kamar" placeholder="cth: 104" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 600; margin-bottom: 4px;">Kategori</label>
                        <select name="type" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;">
                            <option value="keluhan">Fasilitas / AC</option>
                            <option value="perbaikan">Kelistrikan & Air</option>
                            <option value="chat">Pertanyaan Umum</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; margin-bottom: 4px;">Judul Keluhan</label>
                    <input type="text" name="subject" placeholder="cth: Kerusakan AC / Air Mati" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; margin-bottom: 4px;">Detail Masalah</label>
                    <textarea name="body" rows="3" placeholder="Jelaskan kendala secara singkat..." style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; font-family: inherit;" required></textarea>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                    <button type="button" class="lp-btn lp-btn--ghost" onclick="document.getElementById('resvComplaintModal').setAttribute('hidden', '')">Batal</button>
                    <button type="submit" class="lp-btn lp-btn--primary">Kirim Keluhan</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.landing>
