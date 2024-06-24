@extends('layout.guest')

@push('css')
    <style>
        .select2-drop {
            .select2-search {
                display: none
            }
        }
    </style>
@endpush
@section('content')
    <header>
        @include('home.components.navbar')
    </header>

    <main class="container relative flex flex-col gap-10" id="guesthome">
        <section class="section" id="jumbotron">
            <div class="md:w-1/2 p-5 flex flex-col items-start justify-center" id="jumbotron-content">
                <div class="md:text-heading1-bold text-body-bold">
                    Dapatkan Tanah Perumahan Ideal Dengan
                    @include('home.components.blueHouseText')
                </div>
                <p>LandWise menyediakan beragam kriteria yang bisa anda pilih dan sesuaikan dengan sangat mudah.</p>
                <br>
                <a href="#penjelasan" class="navigate-section">
                    @include('home.components.button', ['text' => 'Coba Sekarang'])
                </a>
            </div>
        </section>

        <section class="section" id="penjelasan">
            <div class="p-4 flex flex-col items-center">
                <div>
                    <h2 class="md:text-heading2-semibold text-body-bold text-center">Apa saja spesifikasi tanah perumahan
                        yang
                        disediakan
                        LandWise ?
                    </h2>
                </div>
                <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-6 my-5" id="penjelasan-kriteria">
                    <!-- Sertifikat Tanah -->
                    <div class="p-6 border rounded-md bg-blue-50">
                        {{-- <img src="https://via.placeholder.com/400x200" alt="Luas Tanah" class="rounded-t-lg mb-4"> --}}
                        <h3 class="text-xl font-semibold mb-2">Sertifikat Tanah</h3>
                        <ul class="list-disc ml-6">
                            <li>Hak Milik</li>
                            <li>Hak Hak Guna Bangunan</li>
                            <li>Girik</li>
                        </ul>
                    </div>
                    <!-- Luas Tanah Card -->
                    <div class="p-6 border rounded-md bg-blue-50">
                        {{-- <img src="https://via.placeholder.com/400x200" alt="Luas Tanah" class="rounded-t-lg mb-4"> --}}
                        <h3 class="text-xl font-semibold mb-2">Keterangan Pendaftar Tanah</h3>
                        <ul class="list-disc ml-6">
                            <li>Pemilik Pertama</li>
                            <li>Pemilik Kedua</li>
                            <li>Tanggungan</li>
                        </ul>
                    </div>
                    <div class="p-6 border rounded-md bg-blue-50">
                        {{-- <img src="https://via.placeholder.com/400x200" alt="Luas Tanah" class="rounded-t-lg mb-4"> --}}
                        <h3 class="text-xl font-semibold mb-2">Luas Tanah</h3>
                        <ul class="list-disc ml-6">
                            <li>Lahan 1.300 - 1.600 m<sup>2</sup></li>
                            <li>Lahan 1.100 - 1.300 m<sup>2</sup></li>
                            <li>Lahan 800 - 1.100 m<sup>2</sup></li>
                            <li>Lahan 500 - 800 m<sup>2</sup></li>
                            <li>Lahan 200 - 500 m<sup>2</sup></li>
                        </ul>
                    </div>
                    <!-- Harga Card -->
                    <div class="p-6 border rounded-md bg-blue-50">
                        {{-- <img src="https://via.placeholder.com/400x200" alt="Harga" class="rounded-t-lg mb-4"> --}}
                        <h3 class="text-xl font-semibold mb-2">Harga</h3>
                        <ul class="list-disc ml-6">
                            <li>Rendah (500rb - 1,5 jt/m<sup>2</sup>)</li>
                            <li>Sedang (1,5 - 3 jt/m<sup>2</sup>)</li>
                            <li>Tinggi (> 3 jt/m<sup>2</sup>)</li>
                        </ul>
                    </div>
                    <!-- Saluran Air dan List Card -->
                    <div class="p-6 border rounded-md bg-blue-50">
                        {{-- <img src="https://via.placeholder.com/400x200" alt="Saluran Air" class="rounded-t-lg mb-4"> --}}
                        <h3 class="text-xl font-semibold mb-2">Saluran Air dan Listrik</h3>
                        <ul class="list-disc ml-6">
                            <li>
                                <strong>Tersedia (90-100% atau 0-200 meter)</strong>
                                <p>Saluran air dan listrik tersedia di area ini dengan cakupan 90-100% atau jarak dari tanah
                                    ke saluran
                                    utama tidak lebih dari 200 meter. Ketersediaan sangat baik untuk keperluan
                                    sehari-hari dan kegiatan konstruksi.</p>
                            </li>
                            <li>
                                <strong>Kurang Tersedia (50-90% atau 200-500 meter)</strong>
                                <p>Saluran tersedia di area ini dengan cakupan 50-90% atau jarak dari tanah ke
                                    saluran utama antara 200-500 meter. Mungkin memerlukan tambahan infrastruktur untuk
                                    memastikan pasokan yang memadai.</p>
                            </li>
                            <li>
                                <strong>Tidak Tersedia (&lt;50% atau &gt;500 meter)</strong>
                                <p>Saluran tidak tersedia atau sangat terbatas di area ini dengan cakupan kurang dari
                                    50%
                                    atau jarak dari tanah ke saluran utama lebih dari 500 meter. Mungkin perlu membangun
                                    sistem tersendiri atau mencari sumber lain.</p>
                            </li>
                        </ul>
                    </div>
                    <!-- Fisik Dasar Tanah Card -->
                    <div class="p-6 border rounded-md bg-blue-50">
                        {{-- <img src="https://via.placeholder.com/400x200" alt="Fisik Dasar Tanah" class="rounded-t-lg mb-4"> --}}
                        <h3 class="text-xl font-semibold mb-2">Fisik Dasar Tanah</h3>
                        <ul class="list-disc ml-6">
                            <li>
                                <strong>Normal (kemiringan 0-0,02 meter dari tanah datar)</strong>
                                <p>Tanah yang hampir tidak memiliki kemiringan. Biasanya sangat baik untuk pembangunan
                                    karena
                                    tidak memerlukan pekerjaan tanah yang signifikan.</p>
                            </li>
                            <li>
                                <strong>Agak Miring (kemiringan 0,02-0,05 meter dari tanah datar)</strong>
                                <p>Tanah dengan sedikit kemiringan yang masih cukup mudah untuk diolah.</p>
                            </li>
                            <li>
                                <strong>Miring (kemiringan 0,05-0,15 meter dari tanah datar)</strong>
                                <p>Tanah dengan kemiringan sedang yang memerlukan perencanaan lebih untuk pembangunan.</p>
                            </li>
                            <li>
                                <strong>Sangat Miring (kemiringan >0,15 meter dari tanah datar)</strong>
                                <p>Tanah dengan kemiringan tajam yang memerlukan teknik konstruksi khusus.</p>
                            </li>
                        </ul>
                    </div>

                    <!-- Lokasi Card -->
                    <div class="p-6 border rounded-md bg-blue-50">
                        {{-- <img src="https://via.placeholder.com/400x200" alt="Lokasi" class="rounded-t-lg mb-4"> --}}
                        <h3 class="text-xl font-semibold mb-2">Lokasi</h3>
                        <ul class="list-disc ml-6">
                            <li>Pinggir Kota (10-20 km dari pusat kota)</li>
                            <li>Tengah Kota (5-10 km dari pusat kota)</li>
                            <li>Pusat Kota (0-5 km dari pusat kota)</li>
                        </ul>
                    </div>
                </div>
                <a href="#kriteria" class="navigate-section">
                    @include('home.components.button', ['text' => 'Saya Mengerti dan lanjutkan'])
                </a>
            </div>
        </section>

        <section class="section " id="kriteria">
            <div class="p-4 flex flex-col items-center justify-around">
                <h1 class="text-heading1-semibold text-center">Pilih Kriteria Tanah</h1>
                <div id="kriteriaCheckboxContainer" class="grid md:grid-cols-3 md:gap-4 gap-2 mb-4 validate-checkbox"></div>

                <a href="#alternatif" class="navigate-section">
                    @include('home.components.button', ['text' => 'Lanjut ke jumlah alternatif'])
                </a>
            </div>
        </section>

        <section class="section" id="alternatif">
            <div class="flex flex-col items-center justify-center">
                <h1 class="text-heading1-semibold text-center">Masukan Jumlah Alternatif Tanah Perumahan</h1>

                <div class="p-4">
                    <input type="number" id="alternatifInput" min="2" value="2"
                        class="border p-2 validate-alternatives" placeholder="Enter number of alternatif">
                </div>
                <a href="#spk" id="generateAlternatifBtn"
                    class="bg-blue-500 text-white px-4 py-2 rounded navigate-section">
                    Lanjut ke penilaian alternatif perumahan
                </a>
            </div>
        </section>

        <section class="section" id="spk">
            <div class="p-4">
                <h2 class="text-heading1-semibold text-center">Masukan Kriteria Tiap Alternatif</h2>
                <div id="alternatifContainer" class="grid md:grid-cols-3 grid-cols-1 md:gap-5 gap-2 my-4 validate-spk">
                </div>

                <a href="#hasil" id="calculateBtn">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
                        Hitung Hasil
                        Penilaian
                    </button>
                </a>
            </div>
        </section>

        <section class="section" id="hasil">
            <h2 class="text-heading1-semibold text-center">Hasil Penilaian</h2>
            <p class="text-gray-500 text-center">
                Hasil dari penilaian merupakan hasil yang telah diteliti penulis pada salah satu perumahan. <br>
                Untuk mendapatkan hasil yang lebih akurat dan bisa disesuaikan lebih lanjut, silahkan mendaftar.
            </p>
            <div id="hasilSpk"></div>
        </section>
    </main>
    {{--
    <footer>
        <h2 class="text-heading1-semibold text-center">Created by @hamza</h2>

    </footer> --}}
@endsection


@push('script')
    <script>
        function logging(m, data) {
            const format = {
                message: m,
                data: data
            }
            console.log(format);
        }

        function utilityCalculation(bobotKriteria, bobotSubKriteria) {
            return bobotKriteria * bobotSubKriteria
        }

        function showLink(href) {
            $(href).show();
        }

        $(document).ready(function() {
            // Hide all sections except the first one
            $('.section:not(:first)').hide();

            // When a link with class 'navigate-section' is clicked
            $('.navigate-section').click(function(e) {
                // e.preventDefault();

                if ($(this).closest('.section').find('.validate-checkbox').length > 0) {
                    if ($(this).closest('.section').find('.kriteria-checkbox:checked').length === 0) {
                        alert('Pilih setidaknya 1 kriteria.');
                        return;
                    }
                    $(target).show();
                } else if ($(this).closest('.section').find('.validate-alternatives').length) {
                    // If it requires validation, check if the input field value is empty or less than 2
                    var alternativesInput = $(this).closest('.section').find('#alternatifInput').val();
                    if (!alternativesInput || alternativesInput < 2) {
                        alert('Miniminal Alternatif adalah 2.');

                    }
                }

                var target = $(this).attr('href');
                showLink(target);
            });


            // Fetch kriteria names to create checkboxes
            $.ajax({
                url: '/kriteria/nama/3', // The route we defined in web.php
                method: 'GET',
                success: function(response) {
                    // Clear the existing kriteriaCheckboxContainer content
                    $('#kriteriaCheckboxContainer').empty();

                    // Append each kriteria as a checkbox card
                    $.each(response, function(index, kriteria) {
                        const checkboxHtml =
                            `
                            <div class="border p-4 rounded bg-blue-50 flex items-center gap-2 ">
                                <input type="checkbox" id="checkbox-${kriteria.id}"
                                  class="kriteria-checkbox" data-kriteria-id="${kriteria.id}" data-bobot="${kriteria.bobot}">
                                <label for="checkbox-${kriteria.id}">${kriteria.nama}</label>
                            </div>
                            `
                        $('#kriteriaCheckboxContainer').append(checkboxHtml);
                    });

                    $('#generateAlternatifBtn').click(function() {
                        const numberOfAlternatif = $('#alternatifInput').val();
                        const selectedKriteriaContainer = $('#alternatifContainer');
                        selectedKriteriaContainer.empty();

                        const selectedKriteriaIds = $('.kriteria-checkbox:checked').map(
                            function() {
                                return $(this).data('kriteria-id');
                            }).get();

                        for (let i = 1; i <= numberOfAlternatif; i++) {
                            let alternatifHtml = `
                            <div class="border p-4 rounded shadow mb-4 bg-blue-50">
                              <h3>Alternatif ${i}</h3>
                            `;

                            selectedKriteriaIds.forEach(kriteriaId => {
                                const kriteriaName =
                                    $(`label[for='checkbox-${kriteriaId}']`).text();
                                const kriteriaBobot =
                                    $(`#checkbox-${kriteriaId}`).data('bobot');

                                alternatifHtml += `
                                  <div class="mb-4">
                                      <label for="select2-${i}-${kriteriaId}">${kriteriaName}</label>
                                      <select id="select2-${i}-${kriteriaId}" class="select2-dropdown"
                                        data-kriteria-id="${kriteriaId}"
                                        data-kriteria-bobot="${kriteriaBobot}"
                                        data-kriteria-name="${kriteriaName}"
                                        style="width: 100%;">
                                      </select>
                                  </div>
                                `;
                            });

                            alternatifHtml += `
                                  <div class="error-message-${i}"></div>
                            </div>
                            `;
                            selectedKriteriaContainer.append(alternatifHtml);
                        }



                        // Initialize each Select2 dropdown
                        $('.select2-dropdown').select2({
                            minimumResultsForSearch: -1,
                            ajax: {
                                url: function(params) {
                                    const kriteriaId = $(this).data('kriteria-id');
                                    return `/subkriteria/options/${kriteriaId}`;
                                },
                                dataType: 'json',
                                processResults: function(data) {
                                    // logging('subK', data)
                                    return {
                                        results: data
                                    };
                                }
                            }
                        });
                    });

                    // Handle calculateBtn click event
                    $('#calculateBtn').click(function() {
                        const results = [];
                        let hasError = false
                        $('.error-message').html('');

                        $('#alternatifContainer > div').each(function(index, elem) {
                            const alternatifIndex = index + 1;
                            const alternatif = {
                                index: alternatifIndex,
                                kriteria: []
                            };

                            $(elem).find('.select2-dropdown').each(function() {
                                const kriteriaId = $(this).data('kriteria-id');
                                const kriteriaBobot =
                                    $(this).data('kriteria-bobot');
                                const kriteriaName =
                                    $(this).data('kriteria-name')
                                const subKriteriaName = $(this).text().trim()
                                const selectedSubKriteriaId = $(this).val();

                                // Validate and Show Error
                                const errorEl = $(this).parent().parent()
                                    .children().last()
                                if (!selectedSubKriteriaId) {
                                    hasError = true;
                                    var errorMessage =
                                        '<p class="text-red-500">Pilih semua kriteria terlebih dahulu</p>';
                                    errorEl.html(errorMessage)
                                    return false;
                                } else {
                                    errorEl.html('')
                                }

                                const selectedOption =
                                    $(this).select2('data')[0];
                                const utility = parseFloat(selectedOption
                                    .bobot) * parseFloat(kriteriaBobot)

                                alternatif.kriteria.push({
                                    kriteriaId: kriteriaId,
                                    kriteriaBobot: kriteriaBobot,
                                    subKriteriaId: selectedSubKriteriaId,
                                    subKriteriaBobot: selectedOption
                                        .bobot,
                                    kriteriaName: kriteriaName,
                                    subKriteriaName: selectedOption
                                        .text,
                                    utility: utility
                                });

                            });
                            results.push(alternatif);
                        });

                        if (!hasError) {
                            var target = $(this).attr('href');
                            showLink(target);
                        }



                        // Hitung bobot
                        results.forEach(alternatif => {
                            let totalBobot = 0;
                            alternatif.kriteria.forEach(kriteria => {
                                totalBobot += kriteria.utility;
                            });
                            alternatif.kriterialen = alternatif.kriteria.length
                            alternatif.totalBobot = totalBobot.toFixed(3);
                        });

                        results.sort((a, b) => b.totalBobot - a.totalBobot);

                        // Element Section Hasil

                        let calculationResultsHtml = `
                               <div class="flex flex-wrap gap-3 justify-center">
                          `;

                        results.forEach(
                            (alternatif, index) => {
                                calculationResultsHtml +=
                                    `
                                    <div class="rounded-lg border border-blue-500 table-container">
                                    <table>
                                      <thead>
                                        <tr>
                                            <th colspan="3">
                                              <span class="th-alternatif">Alternatif ${alternatif.index}</span>

                                            </th>
                                            <th>
                                              <span class="th-ranking">
                                                Peringkat ${index+1}
                                              </span>
                                            </th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                    `;
                                alternatif.kriteria.forEach((kriteria, index) => {
                                    const reg = kriteria.subKriteriaName
                                        .replace(/\s*\(.*$/, '').trim();
                                    if (index === 0) {
                                        calculationResultsHtml += `
                                        <tr class="tr-${index}">
                                          <td>${kriteria.kriteriaName}</td>
                                          <td> : </td>
                                          <td>${reg}</td>
                                          <td rowspan="${alternatif.kriterialen}" class="table-td-hightlight">Total Bobot : </br> ${alternatif.totalBobot}</td>
                                        </tr>

                                        `;
                                    } else {
                                        calculationResultsHtml += `
                                        <tr class="tr-${index}">
                                          <td>${kriteria.kriteriaName}</td>
                                          <td> : </td>
                                          <td>${reg}</td>
                                        </tr>

                                        `;
                                    }
                                });
                                calculationResultsHtml +=
                                    `
                                      </tbody>
                                    </table>
                                    </div>
                                    `;
                            });

                        calculationResultsHtml += '</div>';

                        $('#hasilSpk').html('');
                        $('#hasilSpk').append(
                            calculationResultsHtml
                        );
                    });


                    // Handle checkbox change event
                    $('.kriteria-checkbox').change(function() {
                        const selectedKriteriaContainer = $('#selectContainer');
                        selectedKriteriaContainer.empty();

                        $('.kriteria-checkbox:checked').each(function() {
                            const kriteriaId = $(this).data('kriteria-id');
                            const kriteriaName = $(this).next('label').text();

                            const selectHtml = `
                                <div class="mb-4">
                                    <label for="select2-${kriteriaId}">${kriteriaName}</label>
                                    <select id="select2-${kriteriaId}" class="select2-dropdown" data-kriteria-id="${kriteriaId}" style="width: 100%;"></select>
                                </div>
                            `;
                            selectedKriteriaContainer.append(selectHtml);
                        });

                        // Initialize each Select2 dropdown
                        $('.select2-dropdown').select2({
                            minimumResultsForSearch: -1,
                            ajax: {
                                url: function(params) {
                                    const kriteriaId = $(this).data('kriteria-id');
                                    return `/subkriteria/options/${kriteriaId}`;
                                },
                                dataType: 'json',
                                processResults: function(data) {
                                    return {
                                        results: data
                                    };
                                }
                            }
                        });
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });
        });
    </script>
@endpush
