$(document).ready(function() {
    $('* #show-barang').each(function(index, element) {
        $(element).on('click', function() {
            $("#barang-body").html(" ");
            $.ajax({
                url: "/barangs/shows?id=" + $("* #barang_id")[index].value,
                success: (res) => {
                    let barangDetail = 
                    `<div class="card-mb-4 shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6>Nama</h6>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="width: 100%"><b>${res.nama}</b></label>
                                    <h6>Deskripsi</h6>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="width: 100%"><b>${res.deskripsi}</b></label>
                                </div>
                                <div class="col">
                                    <h6>Harga</h6>
                                    <label class="shadow-sm p-3 mb-3 bg-body rounded" style="width: 100%">
                                    <b>${res.harga}</b></label>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    $('#barang-body').html(barangDetail);
                }
            });
        })
    });
})
