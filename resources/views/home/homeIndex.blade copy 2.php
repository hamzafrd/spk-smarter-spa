@extends('layout.guest')

@push('css')
    <style>

    </style>
@endpush
@section('content')
    <header>
        @include('home.components.navbar')
    </header>

    <main class="container relative" id="guesthome">
        <section class="section" id="jumbotron">
            <div class="md:w-1/2 p-5 flex flex-col items-start justify-center" id="jumbotron-content">
                <div class="md:text-heading1-bold text-body-bold">
                    Dapatkan Tanah Perumahan Ideal Dengan
                    @include('home.components.blueHouseText')
                </div>
                <p>BlueHouse menyediakan beragam kriteria yang bisa anda pilih dan sesuaikan dengan sangat mudah.</p>
                <br>
                <a href="#penjelasan" class="navigate-section">
                    @include('home.components.button', ['text' => 'Coba Sekarang'])
                </a>
            </div>
        </section>

        <section class="section hidden" id="penjelasan">
            <div class="flex flex-col items-center">
                <div>
                    <h2 class="md:text-heading2-semibold text-body-bold text-center">Apa saja spesifikasi tanah perumahan
                        yang
                        disediakan
                        bluehouse ?
                    </h2>
                </div>
                <div class="max-w-5xl mx-auto grid grid-cols-2 gap-6 my-5" id="penjelasan-kriteria">
                    <!-- Luas Tanah Card -->
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
                    <!-- Saluran Air Card -->
                    <div class="p-6 border rounded-md bg-blue-50">
                        {{-- <img src="https://via.placeholder.com/400x200" alt="Saluran Air" class="rounded-t-lg mb-4"> --}}
                        <h3 class="text-xl font-semibold mb-2">Saluran Air</h3>
                        <ul class="list-disc ml-6">
                            <li>
                                <strong>Tersedia (90-100% atau 0-100 meter)</strong>
                                <p>Saluran air tersedia di area ini dengan cakupan 90-100% atau jarak dari tanah ke saluran
                                    air
                                    utama tidak lebih dari 100 meter. Ketersediaan air sangat baik untuk keperluan
                                    sehari-hari
                                    dan kegiatan konstruksi.</p>
                            </li>
                            <li>
                                <strong>Kurang Tersedia (50-90% atau 100-500 meter)</strong>
                                <p>Saluran air kurang tersedia di area ini dengan cakupan 50-90% atau jarak dari tanah ke
                                    saluran air utama antara 100-500 meter. Mungkin memerlukan tambahan infrastruktur untuk
                                    memastikan pasokan air yang memadai.</p>
                            </li>
                            <li>
                                <strong>Tidak Tersedia (&lt;50% atau &gt;500 meter)</strong>
                                <p>Saluran air tidak tersedia atau sangat terbatas di area ini dengan cakupan kurang dari
                                    50%
                                    atau jarak dari tanah ke saluran air utama lebih dari 500 meter. Mungkin perlu membangun
                                    sistem air sendiri atau mencari alternatif lain.</p>
                            </li>
                        </ul>
                    </div>
                    <!-- Fisik Dasar Tanah Card -->
                    <div class="p-6 border rounded-md bg-blue-50">
                        {{-- <img src="https://via.placeholder.com/400x200" alt="Fisik Dasar Tanah" class="rounded-t-lg mb-4"> --}}
                        <h3 class="text-xl font-semibold mb-2">Fisik Dasar Tanah</h3>
                        <ul class="list-disc ml-6">
                            <li>
                                <strong>Datar (Kemiringan 0-2%)</strong>
                                <p>Tanah yang hampir tidak memiliki kemiringan. Biasanya sangat baik untuk pembangunan
                                    karena
                                    tidak memerlukan pekerjaan tanah yang signifikan.</p>
                            </li>
                            <li>
                                <strong>Agak Miring (Kemiringan 2-5%)</strong>
                                <p>Tanah dengan sedikit kemiringan yang masih cukup mudah untuk diolah.</p>
                            </li>
                            <li>
                                <strong>Miring (Kemiringan 5-15%)</strong>
                                <p>Tanah dengan kemiringan sedang yang memerlukan perencanaan lebih untuk pembangunan.</p>
                            </li>
                            <li>
                                <strong>Sangat Miring (Kemiringan > 15%)</strong>
                                <p>Tanah dengan kemiringan tajam yang memerlukan teknik konstruksi khusus.</p>
                            </li>
                        </ul>
                    </div>
                    <!-- Saluran Listrik Card -->
                    <div class="p-6 border rounded-md bg-blue-50">
                        {{-- <img src="https://via.placeholder.com/400x200" alt="Saluran Listrik" class="rounded-t-lg mb-4"> --}}
                        <h3 class="text-xl font-semibold mb-2">Saluran Listrik</h3>
                        <ul class="list-disc ml-6">
                            <li>Tersedia (Pasokan konsisten dengan gangguan minimal, tersedia 24/7 atau dalam 0-100 meter ke
                                jalur listrik terdekat)</li>
                            <li>Kurang Tersedia (Pasokan tidak konsisten dengan gangguan sesekali, tersedia dalam 100-500
                                meter
                                ke jalur listrik terdekat)</li>
                            <li>Tidak Tersedia (Tidak ada pasokan konsisten, gangguan sering, atau lebih dari 500 meter ke
                                jalur
                                listrik terdekat)</li>
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

        <section class="section hidden" id="kriteria">
            <div class=" p-4">
                <h1 class="text-heading1-semibold text-center">Pilih Kriteria Tanah</h1>
                <div id="kriteriaCheckboxContainer" class="grid grid-cols-3 gap-4"></div>

                <a href="#alternatif" class="navigate-section">
                    @include('home.components.button', ['text' => 'Lanjut ke jumlah alternatif'])
                </a>
            </div>
        </section>

        <section class="section hidden" id="alternatif">
            <div class="p-4">
                <h2>Input Number of Alternatif</h2>
                <input type="number" id="alternatifInput" min="1" class="border p-2"
                    placeholder="Enter number of alternatif">
                <a href="#spk" id="generateAlternatifBtn"
                    class="bg-blue-500 text-white px-4 py-2 rounded navigate-section">
                    Generate Alternatif
                </a>
            </div>
        </section>

        <section class="section hidden" id="spk">
            <div class="p-4">
                <h2 class="text-heading1-semibold text-center">Masukan Kriteria Tiap Alternatif</h2>
                <div id="alternatifContainer"></div>
                <button id="calculateBtn" class="bg-green-500 text-white px-4 py-2 rounded mt-4">Calculate</button>
            </div>
        </section>
    </main>

    <footer>

    </footer>
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

        $(document).ready(function() {

            $(document).ready(function() {
                // Hide all sections except the first one
                $('.section:not(:first)').hide();

                // When a link with class 'navigate-section' is clicked
                $('.navigate-section').click(function(e) {
                    // e.preventDefault(); // Prevent default anchor behavior

                    var target = $(this).attr('href'); // Get the target section ID from href

                    // Show the target section
                    $(target).show();
                });
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
                            <div class="border p-4 rounded bg-blue-50">
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
                            <div class="border p-4 rounded shadow mb-4">
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

                            alternatifHtml += `</div>`;
                            selectedKriteriaContainer.append(alternatifHtml);
                        }

                        // Initialize each Select2 dropdown
                        $('.select2-dropdown').select2({
                            ajax: {
                                url: function(params) {
                                    const kriteriaId = $(this).data('kriteria-id');
                                    return `/subkriteria/options/${kriteriaId}`;
                                },
                                dataType: 'json',
                                processResults: function(data) {
                                    logging('subK', data)
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

                                if (selectedSubKriteriaId) {
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
                                }
                            });

                            results.push(alternatif);
                        });

                        console.log('Calculation Results:', results);

                        // You can further process the results as needed
                        let calculationResultsHtml =
                            '<div class="mt-4 p-4 border rounded shadow">';
                        results.forEach(alternatif => {
                            calculationResultsHtml +=
                                `<h4>Alternatif ${alternatif.index}</h4>`;
                            let totalBobot = 0;
                            alternatif.kriteria.forEach(kriteria => {
                                calculationResultsHtml += `
                            <p>Kriteria ID: ${kriteria.kriteriaId},
                            Sub Kriteria ID: ${kriteria.subKriteriaId},
                            Bobot Kriteria: ${kriteria.kriteriaBobot},
                            Bobot Sub Kriteria: ${kriteria.subKriteriaBobot},
                            Hasil Utility : ${kriteria.utility}
                            </p>`;
                                totalBobot += kriteria.utility;
                            });

                            calculationResultsHtml +=
                                `<p>Total Bobot: ${totalBobot}</p>`;
                        });

                        calculationResultsHtml += '</div>';
                        $('#alternatifContainer').append(calculationResultsHtml);
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
