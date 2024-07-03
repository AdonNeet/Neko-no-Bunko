// Detail Deskripsi Buku - START
document.addEventListener('DOMContentLoaded', function() {
    // Ambil semua tombol detail
    const descButtons = document.querySelectorAll('.desc_title');
    // Tambahkan event listener untuk setiap tombol detail
    descButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Menghindari aksi default dari tombol submit
    
            // Ambil modal overlay terkait
            const modalOverlay = button.parentElement.querySelector('.modal-overlay');
    
            // Tampilkan modal dengan mengubah display menjadi 'flex'
            modalOverlay.style.display = 'flex';
    
            // Tutup modal saat tombol close-modal diklik
            const closeModalButton = modalOverlay.querySelector('.close-modal');
            closeModalButton.addEventListener('click', function() {
                modalOverlay.style.display = 'none';
            });
    
            // Tutup modal saat mengklik di luar modal
            window.addEventListener('click', function(event) {
                if (event.target === modalOverlay) {
                    modalOverlay.style.display = 'none';
                }
            });
        });
    });
});
// Detail Deskripsi Buku - END


// Fungsi on-click - START
function confirmSubmit() {
    return confirm('Apakah Anda yakin ingin meminjam buku ini?');
}

function confirmReturn() {
    return confirm('Kembalikan buku ini?');
}
// Fungsi on-click - END