@extends('admin.layouts.app')

@section('content')
    
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Manage IKU
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">IKU</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12"> 
            @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif
            <div class="box">
                    <div class="box-header header-tahun-hide">
                        <div class="form-group form-horizontal">
                            <label for="tahun_awal" class="col-sm-1 control-label">Tahun</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="tahun_awal" placeholder="Mulai">
                            </div>
                            <label for="tahun_akhir" class="col-sm-1 control-label">Sampai</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="tahun_akhir" placeholder="Selesai" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="box-header header-opd-hide">
                        <div class="form-group form-horizontal">
                            <label for="opd" class="col-sm-1 control-label">OPD</label>
                            <div class="col-sm-5">
                                <select class="form-control" id="opd">
                                    <option value="">--Pilih OPD--</option>
                                    @foreach ($opds as $opd)
                                        <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                <!-- /.box-header -->
                <hr>
                <div class="box-header header-button-hide">
                    <a
                        href="#"
                        class="btn btn-info btn-cari"
                        ><i class="fa fa-search"></i> Cari</a>
                    <a
                        href="#"
                        class="btn btn-info btn-cetak"
                        ><i class="fa fa-file-pdf-o"></i> Cetak</a>
                    <a
                        href="#"
                        class="btn btn-info btn-tambah"
                        ><i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <button id="showAfterPrint">Load</button>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead style="background-color: #428bca;" id="thead">
                            <tr>
                                <th style="color: #ffffff; text-align: center;">No</th>
                                <th style="color: #ffffff; text-align: center;">Sasaran</th>
                                <th style="color: #ffffff; text-align: center;">Indikator Kinerja</th>
                                <th style="color: #ffffff; text-align: center;">Penjelasan</th>
                                <th style="color: #ffffff; text-align: center;">Penanggung Jawab</th>
                                <th style="color: #ffffff; text-align: center;" id="action">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tabeldata">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Create -->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal form-create">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data IKU</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tahun_awal" class="col-sm-3 control-label">Tahun Awal</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="input-tahun-awal" placeholder="Tahun Awal">
                        </div>
                        <label for="tahun_akhir" class="col-sm-3 control-label">Tahun Akhir</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="input-tahun-akhir" placeholder="Tahun Akhir">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="opd" class="col-sm-3 control-label">OPD</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="input-opd-text" placeholder="OPD">
                            <input type="hidden" class="form-control" id="input-opd-id" placeholder="OPD">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sasaran" class="col-sm-3 control-label">Sasaran</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="input-sasaran" name="sasaran">
                                <option value="">--Pilih Sasaran--</option>
                                @foreach ($sasarans as $sasaran)
                                    <option value="{{ $sasaran->id }}">{{ $sasaran->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="indikator" class="col-sm-3 control-label">Indikator</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="input-indikator" name="indikator">
                                <option value="">--Pilih indikator--</option>
                                @foreach ($indikators as $indikator)
                                    <option value="{{ $indikator->id }}">{{ $indikator->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="penjelasan" class="col-sm-3 control-label">Penjelasan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="input-penjelasan" placeholder="Penjelasan"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="penanggung-jawab" class="col-sm-3 control-label">Penanggug Jawab</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="input-penanggung-jawab" placeholder="Penanggung Jawab">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal form-edit">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data IKU</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="edit-id">
                    <div class="form-group">
                        <label for="tahun_awal" class="col-sm-3 control-label">Tahun Awal</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="edit-tahun-awal" placeholder="Tahun Awal" disabled>
                        </div>
                        <label for="tahun_akhir" class="col-sm-3 control-label">Tahun Akhir</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="edit-tahun-akhir" placeholder="Tahun Akhir" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="opd" class="col-sm-3 control-label">OPD</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit-opd-text" placeholder="OPD" disabled>
                            <input type="hidden" class="form-control" id="edit-opd-id" placeholder="OPD">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sasaran" class="col-sm-3 control-label">Sasaran</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="edit-sasaran" name="sasaran">
                                <option value="">--Pilih Sasaran--</option>
                                @foreach ($sasarans as $sasaran)
                                    <option value="{{ $sasaran->id }}">{{ $sasaran->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="indikator" class="col-sm-3 control-label">Indikator</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="edit-indikator" name="indikator">
                                <option value="">--Pilih indikator--</option>
                                @foreach ($indikators as $indikator)
                                    <option value="{{ $indikator->id }}">{{ $indikator->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="sasaran" class="col-sm-3 control-label">Sasaran</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit-sasaran-text" placeholder="Sasaran">
                            <input type="hidden" class="form-control" id="edit-sasaran-id" placeholder="Sasaran">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="indikator" class="col-sm-3 control-label">Indikator</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit-indikator-text" placeholder="Indikator">
                            <input type="hidden" class="form-control" id="edit-indikator-id" placeholder="Indikator">
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label for="penjelasan" class="col-sm-3 control-label">Penjelasan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="edit-penjelasan" placeholder="Penjelasan"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="penanggung-jawab" class="col-sm-3 control-label">Penanggug Jawab</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit-penanggung-jawab" placeholder="Penanggung Jawab">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Indikator -->
<div class="modal fade" id="modalIndikator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal form-indikator">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Indikator IKU</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="edit-id">
                    <div class="form-group">
                        <label for="tahun_awal" class="col-sm-3 control-label">Tahun Awal</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="edit-tahun-awal" placeholder="Tahun Awal" disabled>
                        </div>
                        <label for="tahun_akhir" class="col-sm-3 control-label">Tahun Akhir</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="edit-tahun-akhir" placeholder="Tahun Akhir" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="opd" class="col-sm-3 control-label">OPD</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit-opd-text" placeholder="OPD" disabled>
                            <input type="hidden" class="form-control" id="edit-opd-id" placeholder="OPD">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sasaran" class="col-sm-3 control-label">Sasaran</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit-sasaran-text" placeholder="Sasaran" disabled>
                            <input type="hidden" class="form-control" id="edit-sasaran-id" placeholder="Sasaran">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="indikator" class="col-sm-3 control-label">Indikator</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit-indikator-text" placeholder="Indikator">
                            <input type="hidden" class="form-control" id="edit-indikator-id" placeholder="Indikator">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="penjelasan" class="col-sm-3 control-label">Penjelasan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="edit-penjelasan" placeholder="Penjelasan"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="penanggung-jawab" class="col-sm-3 control-label">Penanggug Jawab</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit-penanggung-jawab" placeholder="Penanggung Jawab">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $('.btn-cari').on('click', function(e) {
            e.preventDefault();
            $('#tabeldata').empty();

            var tahun_awal = $('#tahun_awal').val();
            var tahun_akhir = $('#tahun_akhir').val();
            var opd = $('#opd').children("option:selected").val();

            showData(tahun_awal, tahun_akhir, opd);
        });

        $('#showAfterPrint').hide();
        $('#showAfterPrint').on('click', function() {
            location.reload();
        });

        $('.btn-cetak').on('click', function(e) {
            e.preventDefault();
            $('.header-tahun-hide').hide();
            $('.header-opd-hide').hide();
            $('.header-button-hide').hide();
            $('table #trLast').hide();
            $('table #action').hide();
            $('table #tdAction').hide();
            $('hr').hide();
            
            window.print();

            $('#showAfterPrint').show();
        });

        $('#tahun_awal').keyup(function() {
            $('#tahun_akhir').val(parseInt($('#tahun_awal').val()) + 4);
        });

        $('.btn-tambah').on('click', function() {
            $('#modalCreate').modal();
        });

        $('.btn-secondary').on('click', function() {
            showData();
        });

        // showData();

        function showData(data_tahun_awal, data_tahun_akhir, data_opd) {
            var tahun_awal = data_tahun_awal;
            var tahun_akhir = data_tahun_akhir;
            var opd = data_opd;

            $.ajax({
                url: 'cariIku2',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    tahun_awal: tahun_awal,
                    tahun_akhir: tahun_akhir,
                    opd: opd
                },
                success: function(response) {     
                    // console.log(response);              
                    $.each(response.data, function(i, value){
                        var tr = "<tr></tr>";
                            tr += "<td>" + parseInt(i + 1) + "</td>";
                            tr += "<td>" + value.data_sasaran.nama + "</td>";
                            tr += "<td>" + value.data_indikator.nama + "</td>";
                            tr += "<td>" + value.penjelasan + "</td>";
                            tr += "<td>" + value.penanggung_jawab + "</td>";
                            tr +=   "<td style=\"width: 90px;\" id=\"tdAction\">" + 
                                            "<div class=\"col-xs-6\" style=\"padding-right: 5px; padding-left: 0;\">" +
                                                "<button class=\"btn btn-info btn-sm btn-block btn-edit\" data-id=\"" + value.id + "\"><i class=\"fa fa-edit\"></i></button>" +
                                            "</div>" +
                                            "<div class=\"col-xs-6\" style=\"padding-right: 5px; padding-left: 0;\">" +
                                                "<button class=\"btn btn-danger btn-sm btn-block btn-delete\" data-id=\"" + value.id + "\"><i class=\"fa fa-trash\"></i></button>" +
                                            "</div>" +
                                        "</td>";
                            tr +=   "</tr>";

                        // var indikator = '';
                        
                        // $.each(value.data_layout, function(i, value_layout) {
                        //     if(indikator == value_layout.indikator_id) {
                        //         tr += "<td></td>";
                        //     } else {
                        //         tr += "<td>" + value_layout.data_indikator.deskripsi + "</td>";
                        //     }                          
                            
                        //     tr += "<td>" + value_layout.penjelasan + "</td>";
                        //     tr += "<td>" + value_layout.penanggung_jawab + "</td>";
                            
                        //     var isLastElement = i == value.data_layout.length -1;

                        //     if (isLastElement) {
                        //         tr +=   "<td style=\"width: 90px;\" id=\"tdAction\">" + 
                        //                     "<div class=\"col-xs-6\" style=\"padding-right: 5px; padding-left: 0;\">" +
                        //                         "<button class=\"btn btn-info btn-sm btn-block btn-edit\" data-id=\"" + value_layout.id + "\"><i class=\"fa fa-edit\"></i></button>" +
                        //                     "</div>" +
                        //                     "<div class=\"col-xs-6\" style=\"padding-right: 5px; padding-left: 0;\">" +
                        //                         "<button class=\"btn btn-danger btn-sm btn-block btn-delete\" data-id=\"" + value_layout.id + "\"><i class=\"fa fa-trash\"></i></button>" +
                        //                     "</div>" +
                        //                 "</td>";
                        //         tr +=   "</tr>";
                        //         tr +=   "<tr id=\"trLast\">" +
                        //                     "<td></td>" +
                        //                     "<td></td>" +
                        //                     "<td><button class=\"btn btn-success btn-indikator\" style=\"padding: 3px 8px 3px 8px;\" data-id=\"" + value_layout.id + "\"><i class=\"fa fa-plus\"></i></button></td>" +
                        //                     "<td colspan=\"6\"></td>" +
                        //                 "</tr>";
                        //     } else {
                        //         tr +=   "<td style=\"width: 90px;\" id=\"tdAction\">" + 
                        //                     "<div class=\"col-xs-6\" style=\"padding-right: 5px; padding-left: 0;\">" +
                        //                         "<button class=\"btn btn-info btn-sm btn-block btn-edit\" data-id=\"" + value_layout.id + "\"><i class=\"fa fa-edit\"></i></button>" +
                        //                     "</div>" +
                        //                     "<div class=\"col-xs-6\" style=\"padding-right: 5px; padding-left: 0;\">" +
                        //                         "<button class=\"btn btn-danger btn-sm btn-block btn-delete\" data-id=\"" + value_layout.id + "\"><i class=\"fa fa-trash\"></i></button>" +
                        //                     "</div>" +
                        //                 "</td>";
                        //         tr +=   "</tr><td></td><td></td>";
                        //     }

                        //     indikator = value_layout.sasaran_id;
                        // });

                        $('#tabeldata').append(tr);
                    });
                }
            });
        }

        // modal create show
        $('#modalCreate').on('show.bs.modal', function() {

            $('#tabeldata').empty();

            var tahun_awal = $('#tahun_awal').val();
            var tahun_akhir = $('#tahun_akhir').val();
            var opd_text = $('#opd').children("option:selected").text();
            var opd_id = $('#opd').children("option:selected").val();

            $('#input-tahun-awal').val(tahun_awal);
            $('#input-tahun-akhir').val(tahun_akhir);
            $('#input-opd-text').val(opd_text);
            $('#input-opd-id').val(opd_id);
        });

        // simpan data renstra
        $('.form-create').on('submit', function(e) {
            e.preventDefault();
            var tahun_awal = $('#input-tahun-awal').val();
            var tahun_akhir = $('#input-tahun-akhir').val();
            var opd_id = $('#input-opd-id').val();
            var sasaran = $('#input-sasaran').val();
            var indikator = $('#input-indikator').val();
            var penjelasan = $('#input-penjelasan').val();
            var penanggung_jawab = $('#input-penanggung-jawab').val();
            
            $.ajax({
                url: 'iku2',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    tahun_awal: tahun_awal,
                    tahun_akhir: tahun_akhir,
                    opd_id: opd_id,
                    sasaran: sasaran,
                    indikator: indikator,
                    penjelasan: penjelasan,
                    penanggung_jawab: penanggung_jawab
                },
                success: function(response) {
                    // console.log(response);
                    if(response.success) {
                        $('#modalCreate').modal('hide');
                        sasaran = $('#input-sasaran').val("");
                        indikator = $('#input-indikator').val("");
                        penjelasan = $('#input-penjelasan').val("");
                        penanggung_jawab = $('#input-penanggung-jawab').val("");
                    }
                    var tahun_awal = $('#tahun_awal').val();
                    var tahun_akhir = $('#tahun_akhir').val();
                    var opd = $('#opd').children("option:selected").val();

                    showData(tahun_awal, tahun_akhir, opd);
                }
            });
        });

        // Edit Data
        $("#tabeldata").on('click', '.btn-edit', function() {
            $('#tabeldata').empty();

            var id = $(this).data('id');
            
            $.ajax({
                    url: '{{ URL::route('iku2.edit', 'id') }}',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id
                        },
                    success: function(response) {
                        // console.log(response.renstra);
                        $('#modalEdit').modal();
                        $('#edit-id').val(response.iku.id);
                        $('#edit-tahun-awal').val(response.iku.tahun_awal);
                        $('#edit-opd-text').val(response.iku.data_opd.nama);
                        $('#edit-opd-id').val(response.iku.data_opd.nama);
                        $('#edit-tahun-akhir').val(response.iku.tahun_akhir);
                        $('#edit-opd').val(response.iku.data_sasaran.opd_id);
                        $('#edit-sasaran').val(response.iku.sasaran_id);
                        $('#edit-indikator').val(response.iku.indikator_id);
                        $('#edit-penjelasan').val(response.iku.penjelasan);
                        $('#edit-penanggung-jawab').val(response.iku.penanggung_jawab);
                    }
            });
        });

        // update data
        $('.form-edit').on('submit', function(e) {
            e.preventDefault();

            var id = $('#edit-id').val();
            var tahun_awal = $('#edit-tahun-awal').val();
            var tahun_akhir = $('#edit-tahun-akhir').val();
            var opd_id = $('#edit-opd-id').val();
            var sasaran_text = $('#edit-sasaran-text').val();
            var sasaran_id = $('#edit-sasaran-id').val();
            var indikator_text = $('#edit-indikator-text').val();
            var indikator_id = $('#edit-indikator-id').val();
            var penjelasan = $('#edit-penjelasan').val();
            var penanggung_jawab = $('#edit-penanggung-jawab').val();

            $.ajax({
                url: '{{ URL::route('iku2.update', 'id') }}',
                type: 'PUT',
                data: {
                    _token: CSRF_TOKEN,
                    id: id,
                    tahun_awal: tahun_awal,
                    tahun_akhir: tahun_akhir,
                    opd_id: opd_id,
                    sasaran_text: sasaran_text,
                    sasaran_id: sasaran_id,
                    indikator_text: indikator_text,
                    indikator_id: indikator_id,
                    penjelasan: penjelasan,
                    penanggung_jawab: penanggung_jawab
                },
                success: function(response) {
                    console.log(response);
                    if(response.success) {
                        $('#modalEdit').modal('hide');
                        sasaran = $('#edit-sasaran').val("");
                        indikator = $('#edit-indikator').val("");
                        penjelasan = $('#edit-penjelasan').val("");
                        penanggung_jawab = $('#edit-penanggung-jawab').val("");
                    }
                    var tahun_awal = $('#tahun_awal').val();
                    var tahun_akhir = $('#tahun_akhir').val();
                    var opd = $('#opd').children("option:selected").val();

                    showData(tahun_awal, tahun_akhir, opd);
                }
            });
        });

        // delete data
        $("#tabeldata").on('click', '.btn-delete', function() {
            $('#tabeldata').empty();
            
            var id = $(this).data('id');
            if (confirm("Yakin akan menghapus?")) {
                $.ajax({
                    url: 'hapusIku2',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id
                    },
                    success: function(response) {
                        var tahun_awal = $('#tahun_awal').val();
                        var tahun_akhir = $('#tahun_akhir').val();
                        var opd = $('#opd').children("option:selected").val();

                        showData(tahun_awal, tahun_akhir, opd);
                    }
                });
            } else {
                var tahun_awal = $('#tahun_awal').val();
                var tahun_akhir = $('#tahun_akhir').val();
                var opd = $('#opd').children("option:selected").val();

                showData(tahun_awal, tahun_akhir, opd);
            }            
        });

        // tambah indikator
        $('#tabeldata').on('click', '.btn-indikator', function() {
            $('#tabeldata').empty();

            var id = $(this).data('id');

            $.ajax({
                url: 'tambahIndikatorIku',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id:id
                },
                success: function(response) {
                    // console.log(response.data.data_tujuan.data_renstra.data_opd.nama);
                    $('#modalIndikator').modal();
                    $('#modalIndikator #edit-tahun-awal').val(response.data.data_sasaran.data_iku.tahun_awal);
                    $('#modalIndikator #edit-tahun-akhir').val(response.data.data_sasaran.data_iku.tahun_akhir);
                    $('#modalIndikator #edit-opd-text').val(response.data.data_sasaran.data_iku.data_opd.nama);
                    $('#modalIndikator #edit-sasaran-text').val(response.data.data_sasaran.deskripsi);
                    $('#modalIndikator #edit-sasaran-id').val(response.data.data_sasaran.id);
                }
            });
        });

        // simpan data indikator
        $('.form-indikator').on('submit', function(e) {
            e.preventDefault();

            var id = $('#modalIndikator #edit-id').val();
            var sasaran_text = $('#modalIndikator #edit-sasaran-text').val();
            var sasaran_id = $('#modalIndikator #edit-sasaran-id').val();
            var indikator_text = $('#modalIndikator #edit-indikator-text').val();
            var indikator_id = $('#modalIndikator #edit-indikator-id').val();
            var penjelasan = $('#modalIndikator #edit-penjelasan').val();
            var penanggung_jawab = $('#modalIndikator #edit-penanggung-jawab').val();
            
            $.ajax({
                url: 'masukkanIndikatorIku',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    sasaran_text: sasaran_text,
                    sasaran_id: sasaran_id,
                    indikator_text: indikator_text,
                    indikator_id: indikator_id,
                    penjelasan: penjelasan,
                    penanggung_jawab: penanggung_jawab
                },
                success: function(response) {
                    console.log(response);
                    if(response.success) {
                        $('#modalIndikator').modal('hide');
                        tujuan = $('#modalIndikator #edit-tujuan-text').val("");
                        sasaran = $('#modalIndikator #edit-sasaran-text').val("");
                        indikator = $('#modalIndikator #edit-indikator-text').val("");
                        penjelasan = $('#modalIndikator #edit-penjelasan').val("");
                        penanggung_jawab = $('#modalIndikator #edit-penanggung-jawab').val("");
                    }
                    var tahun_awal = $('#tahun_awal').val();
                    var tahun_akhir = $('#tahun_akhir').val();
                    var opd = $('#opd').children("option:selected").val();

                    showData(tahun_awal, tahun_akhir, opd);
                }
            });
        });
    });
</script>

@endsection