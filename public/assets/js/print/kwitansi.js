const { jsPDF } = window.jspdf;
$("#btnTest").click(() => {
    const doc = new jsPDF('l', 'mm', [148, 210]); // (orientation, unit, size paper) (A5)

    // border
    doc.setDrawColor(255, 0, 0); // set color for border 
    doc.setLineWidth(1); // set line weight

    doc.rect(10, 5, doc.internal.pageSize.width - 20, doc.internal.pageSize.height - 10, 'S'); // border (x, y, width, heigh)
    
    // set title
    doc.setTextColor(255, 0, 0); // color red
    doc.setFontSize(31); // font size
    doc.setFont(undefined, 'bold'); // set font (text type, format text)
    doc.text("LESTARI MOBILINDO", 15, 17);

    // set text under title
    doc.setTextColor(0, 0, 0); // color black
    doc.setFontSize(10); // font size
    doc.text("JUAL BELI - TUKAR TAMBAH MOBIL BARU DAN BEKAS", 15, 22);

    doc.setFont(undefined, 'normal');
    doc.text("SHOWROOM : Jl. Jend. Sudirman No. 550 A - B KM. 3,5 Palembang (Samping Taman Makan Pahlawan)", 15, 26);

    doc.text("Phone/Fax. 0711 322235", 15, 30);

    // in border radius
    doc.setFillColor(166, 166, 166); // background color for border
    doc.roundedRect(15, 34, 180, 10, 2, 2, 'F'); // (x, y, w, h, xrad, yrad) ('F' stroke)

    doc.setFontSize(18);
    doc.setFont(undefined, 'bold');
    doc.text("KWITANSI", doc.internal.pageSize.width / 2, 41, { align: 'center' })
    
    doc.setFontSize(12);
    doc.setFont(undefined, 'normal');
    doc.text("SUDAH TERIMA DARI", 15, 51);
    doc.text(": ", 65, 51);
    doc.text("BANYAKNYA UANG", 15, 56);
    doc.text(": ", 65, 56);

    doc.text("UNTUK PEMBAYARAN", 15, 66);
    doc.text(": ", 65, 66);
    doc.text("MERK MOBIL", 15, 71);
    doc.text(": ", 65, 71);
    doc.text("TAHUN PEMBUATAN", 15, 76);
    doc.text(": ", 65, 76);
    doc.text("WARNA", 15, 81);
    doc.text(": ", 65, 81);
    doc.text("BAHAN BAKAR", 15, 86);
    doc.text(": ", 65, 86);
    doc.text("ATAS NAMA", 15, 91);
    doc.text(": ", 65, 91);
    doc.text("ALAMAT", 15, 96);
    doc.text(": ", 65, 96);

    doc.text("NO POLISI", 130, 71);
    doc.text(": ", 158, 71);
    doc.text("NO RANGKA", 130, 76);
    doc.text(": ", 158, 76);
    doc.text("NO MESIN", 130, 81);
    doc.text(": ", 158, 81);
    doc.text("NO BPKB", 130, 86);
    doc.text(": ", 158, 86);

    doc.setFontSize(10);
    doc.text("Sisa pelunasan senilai Rp. " + 0 + ", akan diselesaikan selambat-lambatnya pada tanggal ", 15, 101);

    doc.setFontSize(8);
    doc.text("KETERANGAN :", 15, 108);
    doc.text("- Surat-surat lengkap telah diperiksa dan diterima dengan baik oleh pembeli dan kondisi mobil", 15, 112);
    doc.text("dalam keadaan baik/bekas pakai. Pembayaran dengan menggunakan cek/bilyet giro dianggap", 17, 116);
    doc.text("sah apabila cek/bilyet giro sudah dicairkan atau diterima uangnya dengan baik.", 17, 120);
    doc.text("- Bila sisa pelunasan tidak diselesaikan pada tanggal yang disepakati maka uang panjar hangus.", 15, 124);
    doc.text("- Uang panjar dan mobil tidak dapat dikembalikan", 15, 128);

    doc.setFontSize(11);
    doc.text("JUMLAH UANG Rp. ", 15, 137);

    doc.setFillColor(166, 166, 166);
    doc.roundedRect(51, 132, 60, 7, 2, 2, 'F');
    doc.text("500.000.000,-", 53, 137);

    doc.setFontSize(10);
    doc.text("Palembang, 00 September 2023", 143, 112);

    // set name file pdf
    doc.output("dataurlnewwindow");
    // doc.save("test.pdf");
});