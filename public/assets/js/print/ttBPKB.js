const { jsPDF } = window.jspdf;
$("#btnTest").click(() => {
    const doc = new jsPDF('l', 'mm', [148, 210]); // (orientation, unit, size paper) (A5)

    // border
    doc.setDrawColor(255, 0, 0); // set color for border 
    doc.setLineWidth(1); // set line weight

    doc.rect(10, 5, doc.internal.pageSize.width - 20, doc.internal.pageSize.height - 10, 'S'); // border (x, y, width, heigh)
    
    // set title
    doc.setTextColor(255, 0, 0); // color red
    doc.setFontSize(27); // font size
    doc.setFont(undefined, 'bold'); // set font (text type, format text)
    doc.text("LESTARI MOBILINDO", 15, 16); // set text and coordinate

    // set text under title
    doc.setTextColor(0, 0, 0); // color black
    doc.setFontSize(9); // font size
    doc.text("JUAL BELI - TUKAR TAMBAH MOBIL BARU DAN BEKAS", 15, 21);

    doc.setFont(undefined, 'normal');
    doc.text("SHOWROOM : Jl. Jend. Sudirman No. 550 A - B KM. 3,5 Palembang (Samping Taman Makan Pahlawan)", 15, 25);

    doc.text("Phone/Fax. 0711 322235", 15, 29);

    doc.setFontSize(12);
    doc.setFont(undefined, 'bold');
    doc.text("TANDA TERIMA BPKB", doc.internal.pageSize.width / 2, 38, { align: 'center' }); // doc.internal.pageSize.width / 2 -> to set align center at x coordinate

    doc.setFont(undefined, 'normal');
    doc.text("Sudah terima,", 20, 45);

    // left side
    doc.text("Jumlah", 20, 51);
    doc.text(": 1 (satu) buah BPKB", 55, 51);
    doc.text("Nomor BPKB", 20, 57);
    doc.text(": ", 55, 57);
    doc.text("Nama di BPKB", 20, 63);
    doc.text(": ", 55, 63);
    doc.text("Nomor Polisi", 20, 69);
    doc.text(": ", 55, 69);
    doc.text("Warna", 20, 75);
    doc.text(": ", 55, 75);

    // right side
    doc.text("Merk / Tipe", 105, 51);
    doc.text(": ", 143, 51);
    doc.text("Tahun Pembuatan", 105, 57);
    doc.text(": ", 143, 57);
    doc.text("No Mesin", 105, 63);
    doc.text(": ", 143, 63);
    doc.text("No Rangka", 105, 69);
    doc.text(": ", 143, 69);
    doc.text("Alamat", 105, 75);
    doc.text(": ", 143, 75);

    // next (left side)
    doc.text("Dengan Lampiran", 20, 83);
    doc.text("Faktur Asli", 20, 89);
    doc.text(": ", 60, 89);
    doc.text("KTP a/n di BPKB", 20, 95);
    doc.text(": ", 60, 95);
    doc.text("Form", 20, 101);
    doc.text(": ", 60, 101);

    // next (right side)
    doc.text("Kwitansi Blanko a/n di BPKB", 105, 89);
    doc.text(": ", 160, 89);
    doc.text("Kunci Serep", 105, 95);
    doc.text(": ", 160, 95);
    doc.text("Surat Pelepasan Hak", 105, 101);
    doc.text(": ", 160, 101);

    // signature
    doc.text("Yang menerima,", 30, 115);
    doc.text("(\t\t\t\t  )", 25, 138);

    doc.text("Palembang, ", 125, 110);
    doc.text("Yang menyerahkan,", 125, 115);
    doc.text("(\t\t\t\t  )", 123, 138);

    // set name file pdf
    doc.output("dataurlnewwindow");
    // doc.save("test.pdf");
});