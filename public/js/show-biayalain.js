$(document).ready(function() {
    $('* #show-biayalain').each(function(index, element) {
        $(element).on('click', function() {
            $("#biayalain-body").html(" ");
            $.ajax({
                url: "/biaya-lains/details?id=" + $("* #biayalain_id")[index].value,
                success: (res) => {
                    let formatter = new Intl.NumberFormat(
                        'id', { 
                            style: 'currency', 
                            currency: 'IDR',
                            maximumFractionDigits: 0
                        });
                    let formatHargaItem = formatter.format(res.harga);
                    let formatTotal = formatter.format(res.total);
                    let biayaLainDetail = 
                    `<div class="card-mb-4 shadow" style="background-color: #eee;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="text-uppercase text-muted brand">Kode Pembelian</span>
                                    <h5 class="text-uppercase">${res.kode_biayalain}</h5>
                                </div>
                                <div class="col">
                                    <span class="text-uppercase text-muted brand">Tanggal Beli</span>
                                    <h5 class="text-uppercase">${res.tgl_transaksi}</h5>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <span class="brand"><strong>Nama</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    <strong>${res.nama}</strong></label>
                                </div>
                                <div class="col">
                                    <span class="brand"><strong>Jumlah item/Kg</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${res.jumlah}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span class="brand"><strong>Harga per item/Kg</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${formatHargaItem}</label>
                                </div>
                                <div class="col">
                                    <span class="brand"><strong>Total</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${formatTotal}</label>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    $('#biayalain-body').html(biayaLainDetail);
                }
            });
        })
    });
})
