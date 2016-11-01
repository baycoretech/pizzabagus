<div class="row">			
    <div class="col-md-6 col-sm-6">
    	<button type="button" class="btn-block text-left p-0 m-b-15 btn-type" style="border: 0" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'add-standard')) ?>'">
        <div class="widget widget-stats m-b-0 bg-green-lighter">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-pencil-square-o fa-fw"></i></div>
            <div class="stats-title">POST TYPE</div>
            <div class="stats-number">Standard Post</div>
            <div class="stats-progress progress">
                <div class="progress-bar" style="width: 0;"></div>
            </div>
            <div class="stats-desc">Post standard that contains your writing without an image preview.</div>
        </div>
        </button>
    </div>
    <div class="col-md-6 col-sm-6">
    	<button type="button" class="btn-block text-left p-0 m-b-15 btn-type" style="border: 0" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'add-image')) ?>'">
        <div class="widget widget-stats m-b-0 bg-purple">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-picture-o fa-fw"></i></div>
            <div class="stats-title">POST TYPE</div>
            <div class="stats-number">Image</div>
            <div class="stats-progress progress">
                <div class="progress-bar" style="width: 0;"></div>
            </div>
            <div class="stats-desc">Post that contains your writing with an image preview.</div>
        </div>
        </button>
    </div>
    <div class="col-md-6 col-sm-6">
    	<button type="button" class="btn-block text-left p-0 m-b-15 btn-type" style="border: 0" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'add-video')) ?>'">
        <div class="widget widget-stats m-b-0 bg-red">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-youtube-play fa-fw"></i></div>
            <div class="stats-title">POST TYPE</div>
            <div class="stats-number">Video</div>
            <div class="stats-progress progress">
                <div class="progress-bar" style="width: 0;"></div>
            </div>
            <div class="stats-desc">Posts that contain your writing with a video preview. Creatify support Youtube video embed.</div>
        </div>
        </button>
    </div>
    <div class="col-md-6 col-sm-6">
    	<button type="button" class="btn-block text-left p-0 m-b-15 btn-type" style="border: 0" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'add-sound')) ?>'">
        <div class="widget widget-stats m-b-0 bg-orange">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-soundcloud fa-fw"></i></div>
            <div class="stats-title">POST TYPE</div>
            <div class="stats-number">Sound</div>
            <div class="stats-progress progress">
                <div class="progress-bar" style="width: 0;"></div>
            </div>
            <div class="stats-desc">Posts that contain your writing with a sound preview. Creatify support Soundcloud embed.</div>
        </div>
    	</button>
    </div>
</div>