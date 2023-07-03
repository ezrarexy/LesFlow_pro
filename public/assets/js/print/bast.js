const { jsPDF } = window.jspdf;
$("#btnTest").click(() => {
    const doc = new jsPDF('p', 'mm', [148, 210]); // (orientation, unit, size paper) (A5)

    // border
    doc.setDrawColor(255, 0, 0); // set color for border 
    doc.setLineWidth(1); // set line weight

    doc.rect(10, 10, doc.internal.pageSize.width - 20, doc.internal.pageSize.height - 20, 'S'); // border (x, y, width, heigh)
    
    // set title
    doc.setTextColor(255, 0, 0); // color red
    doc.setFontSize(23); // font size
    doc.setFont(undefined, 'bold'); // set font (text type, format text)
    doc.text("LESTARI MOBILINDO", doc.internal.pageSize.width / 2, 19, { align: 'center'}); // set text and coordinate, doc.internal.pageSize.width / 2 -> to set align center at x coordinate

    // set text under title
    doc.setTextColor(0, 0, 0); // color black
    doc.setFontSize(7); // font size
    doc.text("JUAL BELI - TUKAR TAMBAH MOBIL BARU DAN BEKAS", doc.internal.pageSize.width / 2, 23, { align: 'center'});

    doc.setFont(undefined, 'normal');
    doc.text("SHOWROOM : Jl. Jend. Sudirman No. 550 A - B KM. 3,5 Palembang (Samping Taman Makan Pahlawan)", doc.internal.pageSize.width / 2, 26, { align: 'center'});

    doc.text("Phone/Fax. 0711 322235", doc.internal.pageSize.width / 2, 29, { align: 'center'});

    doc.setLineWidth(0.5);
    doc.line(15, 32, 132, 32); // line (xstart, ystart, xend, yend)

    // page 1
    doc.setFontSize(8);
    doc.setFont(undefined, 'bold');
    doc.text("BERITA ACARA SERAH TERIMA KENDARAAN", doc.internal.pageSize.width / 2, 36, { align: 'center' });

    doc.setFont(undefined, 'normal');
    doc.text("Tanggal BAST", 18, 43);
    doc.text(": ", 45, 43);
    doc.text("Syarat Pembayaran", 18, 47);
    doc.text(": ", 45, 47);

    // in border radius
    doc.roundedRect(89, 52, 40, 15, 2, 2, 'S'); // (x, y, w, h, xrad, yrad, type(ambil 'S' saja kalau cuma garis))

    doc.text("Kepada : ", 92, 56);

    // page 2
    doc.setFontSize(8);
    doc.setFont(undefined, 'bold');
    doc.text("DATA KENDARAAN", doc.internal.pageSize.width / 2, 73, { align: 'center' });

    doc.setDrawColor(0, 0, 0);
    doc.line(15, 75, 132, 75);

    // left side
    doc.setFont(undefined, 'normal');
    doc.text("1 (satu) Unit", 18, 80);
    doc.text("Merk / Tipe", 18, 85);
    doc.text(": ", 37, 85);
    doc.text("Jenis / Model", 18, 89);
    doc.text(": ", 37, 89);
    doc.text("No Polisi", 18, 93);
    doc.text(": ", 37, 93);

    // right side
    doc.text("Tahun", 85, 85);
    doc.text(": ", 100, 85);
    doc.text("Warna", 85, 89);
    doc.text(": ", 100, 89);
    doc.text("Kendaraan", 85, 93);
    doc.text(": ", 100, 93);

    // next
    doc.text("No Mesin", 18, 97);
    doc.text(": ", 37, 97);
    // border radius
    doc.setDrawColor(255, 0, 0);
    doc.roundedRect(18, 99, 110, 8, 2, 2, 'S');

    doc.text("No Chasis", 18, 111);
    doc.text(": ", 37, 111);
    doc.roundedRect(18, 113, 110, 8, 2, 2, 'S');

    doc.setDrawColor(0, 0, 0);
    doc.line(15, 124, 132, 124);

    doc.text("Perlengkapan", 18, 129);
    doc.text("STNK Asli", 50, 129);
    doc.text(": ", 70, 129);
    doc.text("Ban Serep", 50, 133);
    doc.text(": ", 70, 133);
    doc.text("Dongkrak", 50, 137);
    doc.text(": ", 70, 137);
    doc.text("Kunci Roda", 50, 141);
    doc.text(": ", 70, 141);

    // caution
    doc.setDrawColor(255, 0, 0);
    doc.roundedRect(18, 145, 52, 15, 2, 2, 'S');
    doc.text("PERHATIAN :", 21, 149);
    doc.text("Semua telah diterima dalam kondisi", 21, 153);
    doc.text("baik / tanpa syarat", 21, 157);

    // new car
    doc.roundedRect(75, 145, 54, 19, 2, 2, 'S');
    doc.text("Unit Mobil Baru", 78, 149);
    doc.text("A/N", 78, 153);
    doc.text(": ", 92, 153);
    doc.text("Alamat", 78, 157);
    doc.text(": ", 92, 157);
    doc.text("Plat Dasar", 78, 161);
    doc.text(": ", 92, 161);

    // signature
    doc.text("Yang menyerahkan,", 27, 174);
    doc.text("(\t\t\t\t  )", 25, 196);

    doc.text("Palembang, ", 85, 170);
    doc.text("Yang menerima,", 85, 174);
    doc.text("(\t\t\t\t  )", 83, 196);

    // set name file pdf
    doc.output("dataurlnewwindow");
    // doc.save("test.pdf");
});