    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Page level plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin.min.js') ?>"></script>

    <!-- Demo scripts for this page-->
    <script src="<?= base_url('assets/js/demo/datatables-demo.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/jquery/jquery-confirm.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>
    <script>
    $(document).ready(function(){
        var nip = '<?= $this->session->userdata('nip') ?>'
        $.ajax({
            url  : '<?= base_url('Notifikasi/getNotif/') ?>'+nip,
            type : 'get',
            success : function(response){
                var html = ''
                $.each(response, function (key, val) {
                    var jenis = val.id_abdimas ? val.id_abdimas : val.id_penelitian
                    var controller = val.id_abdimas ? 'Abdimas/progressDetail/' : 'Penelitian/penelitianDetail/'
                    var link = '<?= base_url()?>'+ controller + jenis
                    var status = ''
                    if (val.id_abdimas) {
                        if (val.id_status_abdimas == 4) {
                            status = 'Pengajuan Abdimas Disetujui'
                        }else if (val.id_status_abdimas == 2) {
                            status = 'Pengajuan Abdimas telah dinyatakan berjalan'
                        }else if (val.id_status_abdimas == 3) {
                            status = 'Pengajuan Abdimas telah dinyatakan selesai'
                        }else if (val.id_status_abdimas == 5) {
                            status = 'Pengajuan Abdimas telah ditolak'
                        }else {
                            status = 'Pengajuan Abdimas Tidak Disetujui'
                        }
                    } else {
                        if (val.id_status_penelitian == 4) {
                            status = 'Pengajuan Penelitian Disetujui'
                        }else if (val.id_status_penelitian == 2) {
                            status = 'Pengajuan Penelitian telah dinyatakan berjalan'
                        }else if (val.id_status_penelitian == 3) {
                            status = 'Pengajuan Penelitian telah dinyatakan selesai'
                        }else if (val.id_status_penelitian == 5){
                            status = 'Pengajuan Penelitian telah ditolak'
                        }else {
                            status = 'Pengajuan Penelitian Disetujui'
                        }
                    }


                    if (val.status == 1) {
                        html += `
                            <button class='dropdown-item disabled' href='#'>${status}</button> 
                        `
                    } else {
                        html += `
                            
                            <button class='dropdown-item' data-id=${val.id_notification} data-link='${link}' id='click-notif'>${status}</button> 
                        `
                    }
                })
                $('#notification').html(html)
            }
        })

        $.ajax({
            url  : '<?= base_url('Notifikasi/countNotif/') ?>'+nip,
            type : 'get',
            success : function(response){
                $('#sumary-notif').text(response.total_notif)
            }
        })

        $(document).on('click', '#click-notif', function () {
            var id = $(this).attr('data-id')
            var link = $(this).attr('data-link')
            console.log(id)
            $.ajax({
                url : '<?= base_url('Notifikasi/readNotif/') ?>'+id,
                type: 'get',
                success: function (res) {
                    console.log(res)
                    window.location.href = link; 
                }
            })
        })
    })

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
