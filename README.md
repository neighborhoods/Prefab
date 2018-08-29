### NOTE
**`master` is currently very outdated. In the meantime, [`4.x`](https://github.com/neighborhoods/prefab/tree/4.x) is a work in progress, but getting very close to completion. Please use that branch for all needs, including documentation.**

---

# Neighborhoods Prefab
A code generation tool.

## Apache Velocity Template Language Files

In an effort to produce pattern consistency and increase contributor velocity, we are using the Apache VTL file integration with PHPStorm as a workaround until `prefab` is in `>=` `1.0.0`.

Currently, while PHPStorm is not running,

`tools/PHPStorm/ApacheVelocityLanguage`

should be able to be copied to

`~/Library/Preferences/PhpStorm2018.1/fileTemplates`

and the copied templates will be ingested by PHPStorm when it is subsequently started.

This should work for updates to these files as well.

Room for improvement includes:
* Ingesting the files within PHPStorm, without using the filesystem directly.

### Example File System Structure
![exmaple-fs-structure](images/example-fs-structure.png)
