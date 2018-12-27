function validasi(form_data){
    if (form_data.nama.value == ""){
        alert("Anda belum mengisikan Nama.");
        form_data.nama.focus();
        return (false);
    }
    return (true);
}

