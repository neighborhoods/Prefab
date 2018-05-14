# Neighborhoods Prefab
A code generation tool.


### Apache Velocity Template Language Files

In an effort to produce pattern consistency and increase contributor velocity, we are using the Apache VTL file integration with PHPStorm as a workaround until `prefab` is in `>=` `1.0.0`.

Currently, while PHPStorm is not running,

`tools/PHPStorm/ApacheVelocityLanguage`

should be able to be copied to

`~/Library/Preferences/PhpStorm2018.1/fileTemplates`

and the copied templates will be ingested by PHPStorm when it is subsequently started.

This should work for updates to these files as well.

Room for improvement includes:
* Ingesting the files within PHPStorm, without using the filesystem directly.
