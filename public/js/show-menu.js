$(document).ready(function() {
    $('* #show-menu').each(function(index, element) {
        $(element).on('click', function() {
            $("#menu-body").html(" ");
            $.ajax({
                url: "/menus/shows?id=" + $("* #menu_id")[index].value,
                success: (res) => {
                    let formatter = new Intl.NumberFormat(
                        'id', { 
                            style: 'currency', 
                            currency: 'IDR',
                            maximumFractionDigits: 0
                        });
                    let formatHarga = formatter.format(res.harga);
                    let menuDetail = `<div class="container-fluid">
                                            <div class="row d-flex">
                                                <div class="col-md">
                                                    <div class="row" style="background-color: #eee;">
                                                        <div class="col-md-6 p-4 d-flex align-items-center">
                                                            <div class="images">
                                                                <div class="text-center">
                                                                    <img src="storage/${res.foto}" style="border-radius: 50%;width:200px;height:160px" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md p-4 rounded-end">
                                                            <div class="mb-4">
                                                                <span class="text-uppercase text-muted brand">${res.kategori}</span>
                                                                <h5 class="text-uppercase">${res.nama}</h5>
                                                                <div class="d-flex flex-row align-items-center">
                                                                    <span class="text-primary fw-500 small">${formatHarga}</span>
                                                                </div>
                                                            </div>
                                                            <p class="about mt-2">
                                                                ${res.deskripsi}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                    $('#menu-body').html(menuDetail);
                }
            });
        })
    });
})
