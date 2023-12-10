$(document).ready(function() {
    $('* #show-supplier').each(function(index, element) {
        $(element).on('click', function() {
            $("#supplier-body").html(" ");
            $.ajax({
                url: "/suppliers/details?id=" + $("* #supplier_id")[index].value,
                success: (res) => {
                    let supplierDetail = 
                    `<div class="card-mb-4 shadow" style="background-color: #eee;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="brand"><strong>Nama</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    <strong>${res.nama}</strong></label>
                                </div>
                                <div class="col">
                                    <span class="brand"><strong>Email</strong></span><br/>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${res.email}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span class="brand"><strong>Nomor Telepon</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${res.no_telp}</label>
                                </div>
                                <div class="col">
                                    <span class="brand"><strong>Kota Asal</strong></span><br/>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${res.kota}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span class="brand"><strong>Alamat</strong></span>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="font-size:15px; width: 100%;">
                                    ${res.alamat}</label>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    $('#supplier-body').html(supplierDetail);
                }
            });
        })
    });
})
