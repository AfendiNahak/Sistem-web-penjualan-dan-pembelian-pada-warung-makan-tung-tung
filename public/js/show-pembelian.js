$(document).ready(function() {
    $('* #show-pembelian').each(function(index, element) {
        $(element).on('click', function() {
            $("#pembelian-body").html(" ");
            $.ajax({
                url: "/pembelians/details?id=" + $("* #pembelian_id")[index].value,
                success: (res) => {
                    let formatter = new Intl.NumberFormat(
                        'id', { 
                            style: 'currency', 
                            currency: 'IDR',
                            maximumFractionDigits: 0
                        });
                    let formatHargaItem = formatter.format(res.satuan);
                    let formatByAngkut = formatter.format(res.biaya_agkt);
                    let formatTotal = formatter.format(res.total);
                    let pembelianDetail = 
                    `<div class="card-mb-4 shadow" style="background-color: #eee;">
                        <div class="card-body">
                            <div>
                                <span class="text-uppercase text-muted brand">Kode Pembelian</span>
                                <h5 class="text-uppercase">${res.kode}</h5>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span class="brand"><strong>Nama</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    <strong>${res.nama_brg}</strong></label>
                                </div>
                                <div class="col">
                                    <span class="brand"><strong>Jumlah item/Kg</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${res.jumlah}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span class="brand"><strong>Tanggal Beli</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${res.tgl_beli}</label>
                                </div>
                                <div class="col">
                                    <span class="brand"><strong>Tanggal Produksi</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${res.tgl_produksi}</label>
                                </div>
                                <div class="col">
                                    <span class="brand"><strong>Kadaluarsa</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${res.exp}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span class="brand"><strong>Harga per item/Kg</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${formatHargaItem}</label>
                                </div>
                                <div class="col">
                                    <span class="brand"><strong>Biaya Angkut</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${formatByAngkut}</label>
                                </div>
                                <div class="col">
                                    <span class="brand"><strong>Total</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${formatTotal}</label>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    $('#pembelian-body').html(pembelianDetail);
                }
            });
        })
    });
})
