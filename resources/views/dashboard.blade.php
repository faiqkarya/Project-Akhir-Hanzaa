<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <x-panel>
        <div class="row pt-2 d-flex justify-content-center">
            <h1 style="font-weight: bold; font-size: 30px;">Aplikasi Penyewaan Barang <br> <span style="font-weight: 400; font-size: 25px;">Dusun Teladan Gampong Garot</span></h1>
        </div>
    </x-panel>

    <x-panel>
        <div class="container-fluid mx-0">
            <div class="row flex mt-4" style="width: 100%;">
                <!-- Kolom Pertama -->
                <div class="col-lg-3 mt-lg-0 mt-3" style="width: 100%;">
                    <div class="row p-2 ms-2 shadow-xl border" style="background-color: #fff; border-radius: 15px;">
                        <div class="col-12">
                            <div class="row mx-2 py-4 h-100 align-items-center" style="border-radius: 10px;">
                                <div class="col-lg-4 text-center">
                                    <p class="p-0 m-0" style="font-size: 40px;">
                                        <i class="bi bi-person-hearts"></i>
                                    </p>
                                </div>
                                <div class="col-lg-8">
                                    <h5 class="text-dark text-lg-start text-center" style="font-weight: bold;">Total Barang</h5>
                                    <h6 class="text-dark text-lg-start text-center">{{ $totalItems }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kedua -->
                <div class="col-lg-3 mt-lg-0 mt-3" style="width: 100%;">
                    <div class="row p-2 ms-2 shadow-xl border" style="background-color: #fff; border-radius: 15px;">
                        <div class="col-12">
                            <div class="row mx-2 py-4 h-100 align-items-center" style="border-radius: 10px;">
                                <div class="col-lg-4 text-center">
                                    <p class="p-0 m-0" style="font-size: 40px;">
                                        <i class="bi bi-clipboard-heart-fill"></i>
                                    </p>
                                </div>
                                <div class="col-lg-8">
                                    <h5 class="text-dark text-lg-start text-center" style="font-weight: bold;">Total Pelanggan</h5>
                                    <h6 class="text-dark text-lg-start text-center">{{ $totalCustomers }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Ketiga -->
                <div class="col-lg-3 mt-lg-0 mt-3" style="width: 100%;">
                    <div class="row p-2 ms-2 shadow-xl border" style="background-color: #fff; border-radius: 15px;">
                        <div class="col-12">
                            <div class="row mx-2 py-4 h-100 align-items-center" style="border-radius: 10px;">
                                <div class="col-lg-4 text-center">
                                    <p class="p-0 m-0" style="font-size: 40px;">
                                        <i class="bi bi-clipboard-heart-fill"></i>
                                    </p>
                                </div>
                                <div class="col-lg-8">
                                    <h5 class="text-dark text-lg-start text-center" style="font-weight: bold;">Total Penyewaan</h5>
                                    <h6 class="text-dark text-lg-start text-center">{{ $totalRentals }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Keempat -->
                <div class="col-lg-3 mt-lg-0 mt-3" style="width: 100%;">
                    <div class="row p-2 ms-2 shadow-xl border" style="background-color: #fff; border-radius: 15px;">
                        <div class="col-12">
                            <div class="row mx-2 py-4 h-100 align-items-center" style="border-radius: 10px;">
                                <div class="col-lg-4 text-center">
                                    <p class="p-0 m-0" style="font-size: 40px;">
                                        <i class="bi bi-clipboard-heart-fill"></i>
                                    </p>
                                </div>
                                <div class="col-lg-8">
                                    <h5 class="text-dark text-lg-start text-center" style="font-weight: bold;">Total Pengembalian</h5>
                                    <h6 class="text-dark text-lg-start text-center">{{ $totalReturnings }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Script js -->

            <script>
                var xValues = ["Total Pelanggan", "Total Barang"];
                var yValues = [JSON.parse("{{ json_encode($totalCustomers) }}"), JSON.parse("{{ json_encode($totalItems) }}")];
                var barColors = ["#b91d47", "#00539F"];

                new Chart("myChart", {
                    type: "doughnut",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Distribusi Data Pelanggan dan Barang"
                        }
                    }
                });
            </script>
            <!-- End Script js -->

        </div>
    </x-panel>
</x-app-layout>