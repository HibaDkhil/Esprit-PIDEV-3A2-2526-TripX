<?php echo strip_tags(file_get_contents('http://127.0.0.1:8000/', false, stream_context_create(['http'=>['ignore_errors'=>true]])));
