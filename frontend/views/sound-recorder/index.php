<?php
/* @var $this yii\web\View */

$this->title = 'Sound Recorder';
?>

<div class="container">
    <h1><a href="https://github.com/higuma/web-audio-recorder-js">WebAudioRecorder.js</a> demo</h1>
    <p>Audio recording to WAV / OGG / MP3 with Web Audio API</p>
    <hr>
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">Audio input</label>
            <div class="col-sm-3">
                <select id="audio-in-select" class="form-control"><option value="no-input">(No input)</option><option value="hNuU7RUeKvog1ADKpTIxdUDXOlYiWMxnyz8kGPZn9xI=" selected="selected">Audio in 1</option><option value="dBOYxKRZXHzbu1wY1PZxOTuUqtkf61GMhq7vHI1Uusc=">Audio in 2</option></select>
            </div>
            <div class="col-sm-3">
                <input id="audio-in-level" min="0" max="100" value="0" class="" type="range">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-3">
                <input id="echo-cancellation" type="checkbox"> Enable echo cancellation
            </div>
            <div class="col-sm-6 text-warning"><strong>Experimental:</strong> cancellation on/off may work on Chrome only.</div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Test tone</label>
            <div class="col-sm-3"></div>
            <div class="col-sm-3">
                <input id="test-tone-level" min="0" max="100" value="0" type="range">
            </div>
        </div><br>
        <div class="form-group">
            <label class="col-sm-3 control-label">Recording time limit</label>
            <div class="col-sm-3">
                <input id="time-limit" min="1" max="10" value="3" type="range">
            </div>
            <div id="time-limit-text" class="col-sm-6">3 minutes</div>
        </div><br>
        <div class="form-group">
            <label class="col-sm-3 control-label">Encoding</label>
            <div class="col-sm-3">
                <input name="encoding" encoding="wav" checked="checked" type="radio"> .wav &nbsp; 
                <input name="encoding" encoding="ogg" type="radio"> .ogg &nbsp; 
                <input name="encoding" encoding="mp3" type="radio"> .mp3
            </div>
            <label id="encoding-option-label" class="col-sm-2 control-label"></label>
            <div class="col-sm-2">
                <input id="encoding-option" min="0" max="11" value="6" class="hidden" type="range">
            </div>
            <div id="encoding-option-text" class="col-sm-2"></div>
        </div><br>
        <div class="form-group">
            <label class="col-sm-3 control-label">Encoding process</label>
            <div class="col-sm-9">
                <input name="encoding-process" mode="background" checked="checked" type="radio"> Encode on recording background
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-3">
                <input name="encoding-process" mode="separate" type="radio"> Encode after recording (safer)
            </div>
            <label id="report-interval-label" class="col-sm-2 control-label hidden">Reports every</label>
            <div class="col-sm-2">
                <input id="report-interval" min="1" max="5" value="1" class="hidden" type="range">
            </div>
            <div id="report-interval-text" class="col-sm-2 hidden">1 second</div>
        </div><br>
        <div class="form-group">
            <label class="col-sm-3 control-label">Recording buffer size</label>
            <div class="col-sm-2">
                <input id="buffer-size" min="0" max="6" value="4" type="range">
            </div>
            <div id="buffer-size-text" class="col-sm-7">4096 (browser default)</div>
        </div>
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-9 text-warning"><strong>Notice: </strong> recording becomes unstable if buffer size is below browser default.</div>
        </div><br>
        <div class="form-group">
            <div class="col-sm-3 control-label"><span id="recording" class="text-danger hidden"><strong>RECORDING</strong></span>&nbsp; <span id="time-display">00:00</span></div>
            <div class="col-sm-3">
                <button id="record" class="btn btn-danger">RECORD</button>
                <button id="cancel" class="btn btn-default hidden">CANCEL</button>
            </div>
            <div class="col-sm-6"><span id="date-time" class="text-info">Tue Oct 03 2017 10:49:32 GMT-0400</span></div>
        </div>
    </div>
    <hr>
    <h3>Recordings</h3>
    <div id="recording-list"></div>
</div>
<div id="modal-loading" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Loading WAV encoder ...</h4>
            </div>
        </div>
    </div>
</div>
<div id="modal-progress" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div style="width: 0.0%;" class="progress-bar"></div>
                </div>
                <div class="text-center">0.0%</div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div id="modal-error" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" class="close">×</button>
                <h4 class="modal-title">Error</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning"></div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
            </div>
        </div>
    </div>
</div>
