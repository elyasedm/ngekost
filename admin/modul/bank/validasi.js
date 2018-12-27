function validasi(form_data){
    if (form_data.nama.value == ""){
        alert("Anda belum mengisikan Nama.");
        form_data.nama.focus();
        return (false);
    }

    if (form_data.no_rekening.value == ""){
        alert("Anda belum mengisikan No Rekening.");
        form_data.no_rekening.focus();
        return (false);
    }
    
    if (form_data.nama_nasabah.value == ""){
        alert("Anda belum mengisikan Nama Nasabah.");
        form_data.nama_nasabah.focus();
        return (false);
    }
    return (true);
}

