fis.config.set('modules.optimizer.tpl', 'html-compress');

fis.config.set('settings.smarty.left_delimiter', '{');
fis.config.set('settings.smarty.right_delimiter', '}');

fis.config.merge({
    roadmap : {
        path : [
            {
		        reg : 'map.json',
		        release : 'oa_application/third_party/Smarty-3.1.11/configs/$&'
		    },
		    {
		    	reg : 'public/common/**',
		    	useHash : false,
		    	useCompile : false
		    },
		    {
                reg : '**.png',
                useMap : true ,
                release : '$&'
            },
		    {
                reg : '**.gif',
                useMap : true ,
                release : '$&'
            },
            {
                reg : '**.jpg',
                useMap : true ,
                release : '$&'
            }
        ]
    }
});


