$("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});

function formatNumber(n) {
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrency(input, blur) {
  var input_val = input.val();
  if (input_val === "") { return; }
  var original_len = input_val.length;
  var caret_pos = input.prop("selectionStart");
  if (input_val.indexOf(".") >= 0) {
    var decimal_pos = input_val.indexOf(".");
    var left_side = input_val.substring(0, decimal_pos);
    left_side = formatNumber(left_side);
    input_val = left_side;

  } else {
    input_val = formatNumber(input_val);
    input_val = input_val;
    if (blur === "blur") {
      input_val;
    }
  }
  input.val(input_val);
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

function sumar() { 
    var total_harga = 0;
    var total_biaya = 0;
    var inputJumlah = +document.getElementById('jumlahInput').value;
    // var inputBiayaAngkut = +document.getElementById('biayaAgktInput').value;
  $(".harga").each(function() {
    if (isNaN(parseFloat($(this).val()))) {
      total_harga += 0;
    } else {
   var $this = $( this );
    var input = $this.val();
    var input = input.replace(/[\D\s\._\-]+/g, ""); 
    input = input ? parseInt( input, 10 ) : 0;
    total_harga += input; 
    }
  });
  $(".biaya").each(function() {
    if (isNaN(parseFloat($(this).val()))) {
      total_biaya += 0;
    } else {
   var $this = $( this );
    var input = $this.val();
    var input = input.replace(/[\D\s\._\-]+/g, ""); 
    input = input ? parseInt( input, 10 ) : 0;
    total_biaya += input; 
    }
  });
  total_harga = total_harga*inputJumlah+total_biaya;
  document.getElementById('total').value = total_harga.toLocaleString( "id-ID" ); 
}