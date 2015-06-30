<?php
/**
 * Created by PhpStorm.
 * User: SlashMan
 * Date: 13.05.2015
 * Time: 14:15
 */

?>

<div class="settings-content col-md-11">
    <nav class="breadcrumbs">
        Журнал событий
    </nav>
    <div class="col-md-12 settings-tab-contents">
        <div class="settings--wrapper">
            <h2 class="settings--header">Статус</h2>
            <p class="settings--header-subtitle">Отображение статуса и лога устройства.</p>
            <div class="settings--aside">
                <center>
                    <table border="0px" style="background-color: transparent; margin-bottom: 35px;">
                        <tbody><tr>
                            <td width="200px">
                                Статус системы:
                            </td>
                            <td>
                                <input type="checkbox" id="status-enable" value=""></td>
                        </tr>
                        </tbody></table>


                    <input class="btn btn-primary" style="width: 219px" type="button" value="Сохранить" onclick="saveSystem();"></center>
            </div>
            <center>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped" id="operators" width="100%" style="margin-top: 10px;">
                    <thead>
                    <tr>
                        <th>Время</th>
                        <th>От</th>
                        <th>Кому</th>
                        <th>Описание</th>
                        <th>Файл</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach(Log::model()->findAll() as $log): ?>
                        <tr>
                            <td class="col-md-2">
                                <?=$log->happened;?>
                            </td>
                            <td>
                                <?=$log->from;?>
                            </td>
                            <td>
                                <?=$log->to;?>
                            </td>
                            <td>
                                <?=$log->details;?>
                            </td>
                            <td class="text-center">
                                <?php if($log->attachment): ?>
                                    <button class="btn btn-xs btn-success log-button" attachment="<?=$log->attachment?>">
                                        <i class="fa fa-info"></i>
                                    </button>
                                <?php endif; ?>
                            </td>
                            <!--    <?php /*if($log->attachment): */?>
                                    <audio preload="auto" controls>
                                        <source src="<?/*=Yii::app()->request->baseUrl.'/attachments/'.$log->attachment*/?>" />
                                    </audio>
                                <?php /*endif; */?>
                                <?/*=$log->attachment ? CHtml::link('<i class="fa fa-download fa-2x pull-right"></i>',$this->createUrl('/site/download',['file' => $log->attachment])) : '';*/?>
                            </td>-->
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </center>
        </div>
    </div>
</div>
<div class="modal fade" id="attachmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 modal-container text-center">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).on('click', '.log-button', function(){
        var button = $(this);
        $('#attachmentModal .modal-container').html(
            '<audio preload="auto" controls><source src="/attachments/' + $(button).attr('attachment') + '"/></audio>' +
            '<div class="col-md-12 text-center"><a href="/attachments/' + $(button).attr('attachment') + '" class="btn btn-success"><i class="fa fa-download"></i></a></div>'
        );

        $('#attachmentModal').modal('show');
    })
</script>
<style>


.audioplayer
{
    height: 2.5em; /* 40 */
    color: #fff;
    text-shadow: 1px 1px 0 #000;
    border: 1px solid #222;
    position: relative;
    z-index: 1;
    background: #333;
}


/* mini mode (fallback) */

.audioplayer-mini
{
    width: 2.5em; /* 40 */
    margin: 0 auto;
}


/* player elements: play/pause and volume buttons, played/duration timers, progress bar of loaded/played */

.audioplayer > div
{
    position: absolute;
}


/* play/pause button */

.audioplayer-playpause
{
    width: 2.5em; /* 40 */
    height: 100%;
    text-align: left;
    text-indent: -9999px;
    cursor: pointer;
    z-index: 2;
    top: 0;
    left: 0;
}
.audioplayer:not(.audioplayer-mini) .audioplayer-playpause
{
    border-right: 1px solid #555;
    border-right-color: rgba( 255, 255, 255, .1 );
}
.audioplayer-mini .audioplayer-playpause
{
    width: 100%;
}
.audioplayer-playpause:hover,
.audioplayer-playpause:focus
{
    background-color: #222;
}
.audioplayer-playpause a
{
    display: block;
}
.audioplayer-stopped .audioplayer-playpause a
{
    width: 0;
    height: 0;
    border: 0.5em solid transparent; /* 8 */
    border-right: none;
    border-left-color: #fff;
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -0.5em 0 0 -0.25em; /* 8 4 */
}
.audioplayer-playing .audioplayer-playpause a
{
    width: 0.75em; /* 12 */
    height: 0.75em; /* 12 */
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -0.375em 0 0 -0.375em; /* 6 */
}
.audioplayer-playing .audioplayer-playpause a:before,
.audioplayer-playing .audioplayer-playpause a:after
{
    width: 40%;
    height: 100%;
    background-color: #fff;
    content: '';
    position: absolute;
    top: 0;
}
.audioplayer-playing .audioplayer-playpause a:before
{
    left: 0;
}
.audioplayer-playing .audioplayer-playpause a:after
{
    right: 0;
}


/* timers */

.audioplayer-time
{
    width: 4.375em; /* 70 */
    height: 100%;
    line-height: 2.375em; /* 38 */
    text-align: center;
    z-index: 2;
    top: 0;
}
.audioplayer-time-current
{
    border-left: 1px solid #111;
    border-left-color: rgba( 0, 0, 0, .25 );
    left: 2.5em; /* 40 */
}
.audioplayer-time-duration
{
    border-right: 1px solid #555;
    border-right-color: rgba( 255, 255, 255, .1 );
    right: 2.5em; /* 40 */
}
.audioplayer-novolume .audioplayer-time-duration
{
    border-right: 0;
    right: 0;
}


/* progress bar of loaded/played */

.audioplayer-bar
{
    height: 0.875em; /* 14 */
    background-color: #222;
    cursor: pointer;
    z-index: 1;
    top: 50%;
    right: 6.875em; /* 110 */
    left: 6.875em; /* 110 */
    margin-top: -0.438em; /* 7 */
}
.audioplayer-novolume .audioplayer-bar
{
    right: 4.375em; /* 70 */
}
.audioplayer-bar div
{
    width: 0;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
}
.audioplayer-bar-loaded
{
    background-color: #333;
    z-index: 1;
}
.audioplayer-bar-played
{
    background: #007fd1;
    z-index: 2;
}


/* volume button */

.audioplayer-volume
{
    width: 2.5em; /* 40 */
    height: 100%;
    border-left: 1px solid #111;
    border-left-color: rgba( 0, 0, 0, .25 );
    text-align: left;
    text-indent: -9999px;
    cursor: pointer;
    z-index: 2;
    top: 0;
    right: 0;
}
.audioplayer-volume:hover,
.audioplayer-volume:focus
{
    background-color: #222;
}
.audioplayer-volume-button
{
    width: 100%;
    height: 100%;
}
.audioplayer-volume-button a
{
    width: 0.313em; /* 5 */
    height: 0.375em; /* 6 */
    background-color: #fff;
    display: block;
    position: relative;
    z-index: 1;
    top: 40%;
    left: 35%;
}
.audioplayer-volume-button a:before,
.audioplayer-volume-button a:after
{
    content: '';
    position: absolute;
}
.audioplayer-volume-button a:before
{
    width: 0;
    height: 0;
    border: 0.5em solid transparent; /* 8 */
    border-left: none;
    border-right-color: #fff;
    z-index: 2;
    top: 50%;
    right: -0.25em;
    margin-top: -0.5em; /* 8 */
}
.audioplayer:not(.audioplayer-muted) .audioplayer-volume-button a:after
{
    /* "volume" icon by Nicolas Gallagher, http://nicolasgallagher.com/pure-css-gui-icons */
    width: 0.313em; /* 5 */
    height: 0.313em; /* 5 */
    border: 0.25em double #fff; /* 4 */
    border-width: 0.25em 0.25em 0 0; /* 4 */
    left: 0.563em; /* 9 */
    top: -0.063em; /* 1 */
    -webkit-border-radius: 0 0.938em 0 0; /* 15 */
    -moz-border-radius: 0 0.938em 0 0; /* 15 */
    border-radius: 0 0.938em 0 0; /* 15 */
    -webkit-transform: rotate( 45deg );
    -moz-transform: rotate( 45deg );
    -ms-transform: rotate( 45deg );
    -o-transform: rotate( 45deg );
    transform: rotate( 45deg );
}


/* volume dropdown */

.audioplayer-volume-adjust
{
    height: 6.25em; /* 100 */
    cursor: default;
    position: absolute;
    left: 0;
    right: -1px;
    top: -9999px;
    background: #333;
}
.audioplayer-volume:not(:hover) .audioplayer-volume-adjust
{
    opacity: 0;
}
.audioplayer-volume:hover .audioplayer-volume-adjust
{
    top: auto;
    bottom: 100%;
}
.audioplayer-volume-adjust > div
{
    width: 40%;
    height: 80%;
    background-color: #222;
    cursor: pointer;
    position: relative;
    z-index: 1;
    margin: 30% auto 0;
}
.audioplayer-volume-adjust div div
{
    width: 100%;
    height: 100%;
    position: absolute;
    bottom: 0;
    left: 0;
    background: #007fd1;
}
.audioplayer-novolume .audioplayer-volume
{
    display: none;
}


/* CSS3 decorations */

body
{
    -webkit-box-shadow: inset 0 0 18.75em rgba( 0, 0, 0, .5 ); /* 300 */
    -moz-box-shadow: inset 0 0 18.75em rgba( 0, 0, 0, 5 ); /* 300 */
    box-shadow: inset 0 0 18.75em rgba( 0, 0, 0, .5 ); /* 300 */
}
.audioplayer
{
    -webkit-box-shadow: inset 0 1px 0 rgba( 255, 255, 255, .15 ), 0 0 1.25em rgba( 0, 0, 0, .5 ); /* 20 */
    -moz-box-shadow: inset 0 1px 0 rgba( 255, 255, 255, .15 ), 0 0 1.25em rgba( 0, 0, 0, .5 ); /* 20 */
    box-shadow: inset 0 1px 0 rgba( 255, 255, 255, .15 ), 0 0 1.25em rgba( 0, 0, 0, .5 ); /* 20 */
}
.audioplayer-volume-adjust
{
    -webkit-box-shadow: -2px -2px 2px rgba( 0, 0, 0, .15 ), 2px -2px 2px rgba( 0, 0, 0, .15 );
    -moz-box-shadow: -2px -2px 2px rgba( 0, 0, 0, .15 ), 2px -2px 2px rgba( 0, 0, 0, .15 );
    box-shadow: -2px -2px 2px rgba( 0, 0, 0, .15 ), 2px -2px 2px rgba( 0, 0, 0, .15 );
}
.audioplayer-bar,
.audioplayer-volume-adjust > div
{
    -webkit-box-shadow: -1px -1px 0 rgba( 0, 0, 0, .5 ), 1px 1px 0 rgba( 255, 255, 255, .1 );
    -moz-box-shadow: -1px -1px 0 rgba( 0, 0, 0, .5 ), 1px 1px 0 rgba( 255, 255, 255, .1 );
    box-shadow: -1px -1px 0 rgba( 0, 0, 0, .5 ), 1px 1px 0 rgba( 255, 255, 255, .1 );
}
.audioplayer-volume-adjust div div,
.audioplayer-bar-played
{
    -webkit-box-shadow: inset 0 0 5px rgba( 255, 255, 255, .5 );
    -moz-box-shadow: inset 0 0 5px rgba( 255, 255, 255, .5 );
    box-shadow: inset 0 0 5px rgba( 255, 255, 255, .5 );
}
.audioplayer-playpause,
.audioplayer-volume a
{
    -webkit-filter: drop-shadow( 1px 1px 0 #000 );
    -moz-filter: drop-shadow( 1px 1px 0 #000 );
    -ms-filter: drop-shadow( 1px 1px 0 #000 );
    -o-filter: drop-shadow( 1px 1px 0 #000 );
    filter: drop-shadow( 1px 1px 0 #000 );
}
.audioplayer,
.audioplayer-volume-adjust
{
    background: -webkit-gradient( linear, left top, left bottom, from( #444 ), to( #222 ) );
    background: -webkit-linear-gradient( top, #444, #222 );
    background: -moz-linear-gradient( top, #444, #222 );
    background: -ms-radial-gradient( top, #444, #222 );
    background: -o-linear-gradient( top, #444, #222 );
    background: linear-gradient( to bottom, #444, #222 );
}
.audioplayer-bar-played
{
    background: -webkit-gradient( linear, left top, right top, from( #007fd1 ), to( #c600ff ) );
    background: -webkit-linear-gradient( left, #007fd1, #c600ff );
    background: -moz-linear-gradient( left, #007fd1, #c600ff );
    background: -ms-radial-gradient( left, #007fd1, #c600ff );
    background: -o-linear-gradient( left, #007fd1, #c600ff );
    background: linear-gradient( to right, #007fd1, #c600ff );
}
.audioplayer-volume-adjust div div
{
    background: -webkit-gradient( linear, left bottom, left top, from( #007fd1 ), to( #c600ff ) );
    background: -webkit-linear-gradient( bottom, #007fd1, #c600ff );
    background: -moz-linear-gradient( bottom, #007fd1, #c600ff );
    background: -ms-radial-gradient( bottom, #007fd1, #c600ff );
    background: -o-linear-gradient( bottom, #007fd1, #c600ff );
    background: linear-gradient( to top, #007fd1, #c600ff );
}
.audioplayer-bar,
.audioplayer-bar div,
.audioplayer-volume-adjust div
{
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.audioplayer
{
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
}
.audioplayer-volume-adjust
{
    -webkit-border-top-left-radius: 2px;
    -webkit-border-top-right-radius: 2px;
    -moz-border-radius-topleft: 2px;
    -moz-border-radius-topright: 2px;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
}
.audioplayer *,
.audioplayer *:before,
.audioplayer *:after
{
    -webkit-transition: color .25s ease, background-color .25s ease, opacity .5s ease;
    -moz-transition: color .25s ease, background-color .25s ease, opacity .5s ease;
    -ms-transition: color .25s ease, background-color .25s ease, opacity .5s ease;
    -o-transition: color .25s ease, background-color .25s ease, opacity .5s ease;
    transition: color .25s ease, background-color .25s ease, opacity .5s ease;
}
</style>
<script>
    $(document).ready(function(){

        //$( 'audio' ).audioPlayer();
    })
</script>