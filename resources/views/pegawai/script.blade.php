<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
    <!-- digunakan untuk pencarian dan pagination -->
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({ //untuk mencetak data yg sudah di create di database
                processing: true, //sudah ketentuannya
                serverside: true,
                ajax: "{{ url('pegawaiAjax') }}", //alamat untuk melakukan akses pada data2 kita
                columns: [{ // masukkan kolom2 apa saja yang akan kita gunakan untuk penomoran data 
                    data: 'DT_RowIndex', //penambahan dari controller agar urutannya sesuai
                    name: 'DT_RowIndex',
                    orderable: false, //agar urutannya tetap
                    searchable: false
                }, {
                    data: 'nama',
                    name: 'Nama'
                }, {
                    data: 'email',
                    name: 'Email'
                }, {
                    data: 'aksi',
                    name: 'Aksi'
                }]
            });
        });

        // GLOBAL SETUP
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // 02_PROSES SIMPAN 
        $('body').on('click','.tombol-tambah', function(e) {
            e.preventDefault(); //fungsinya agar tidak merefresh saat klik tombol tambah data
            $('#exampleModal').modal('show');

            $('.tombol-simpan').click(function() {
                // disini membutuhkan parameter yang nantinya akan dikirimkan ke controller
                // gunakan sebuah metode yaitu ajax untuk mengirimkannya
                $.ajax({
                    url: 'pegawaiAjax', //memanggil controller pada store
                    type: 'POST',
                    data: {
                        nama : $('#nama').val(), // menangkap data yang telah di klik simpan, buat variabel nama baru dan ditangkap melalui val/valuenya
                        email : $('#email').val() //yang di tanda # merupakan id yang ingin ditangkap oleh variabel yang kita buat
                    },
                    success:function(response) { //data yang sukses akam masuk ke sebuah variabel, dan variabelnya kita bisa masukkan ke dalam sebuah parameter
                        // fungsi agar tabelnya merefresh setelah data berhasil ditambahkan
                        if(response.errors) {
                            console.log(response.errors);
                            $('.alert-danger').removeClass('d-none');
                            $('.alert-anger').append("<ul>"); // agar tampil terlebih dahulu ketika ada error
                            $.each(response.errors, function(key, value) {
                                $('.alert-anger').append("<li>" + value + "</li>");
                            });
                            $('.alert-anger').append("</ul>");
                        }
                        $('#myTable').DataTable().ajax.reload();
                    }
                })
            })
        });
    </script>