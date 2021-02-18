# Changelog

<a name="2020.10.2"></a>
## 2020.10.2 (2021-02-18)

### Changed

- 📌 Adds `package-lock.json` [[6548f04](https://github.com/skyunlimitedinc/ays/commit/6548f048e9ba8db7257d8d989dddba170c6770f5)]


<a name="2020.10.1"></a>
## 2020.10.1 (2021-02-18)

### Fixed

- 💚 Re-adds the encoded travis environment file [[27b53d1](https://github.com/skyunlimitedinc/ays/commit/27b53d1d41d3bd39ba0d6002181a1108f980c498)]


<a name="2020.10.0"></a>
## 2020.10.0 (2021-02-18)

### Added

- 👷‍♂️ Save some time during artisan commands [[654d56d](https://github.com/skyunlimitedinc/ays/commit/654d56d6d85253998c6bbfa0d39e71269588858d)]
- 👷‍♂️ Set deployment to run from two branches [[2e9712f](https://github.com/skyunlimitedinc/ays/commit/2e9712fe2dda56fe9d9f88aa70ea7270c864d609)]
- ➕ Adds ext-pdo for updating the database config [[fe94304](https://github.com/skyunlimitedinc/ays/commit/fe943046b4828db0d708a3a68420c10f24e5f843)]

### Changed

- 🚨 Lints the deployment shell script [[11b337d](https://github.com/skyunlimitedinc/ays/commit/11b337de9e736f4c9cd8106f8b15f00f8f90ffb9)]
- 🔧 Configures PhpRedis and sets it to be used for caching [[75fc9a3](https://github.com/skyunlimitedinc/ays/commit/75fc9a34e8505f9fd26db290e310d055a4a81158)]
- ⚡ Adds caching to the `ProductController` [[1b1bd40](https://github.com/skyunlimitedinc/ays/commit/1b1bd40fe2b57e184647f858099fcbece9f19dff)]
- 🎨 Prettifies `ProductController` [[b408e4a](https://github.com/skyunlimitedinc/ays/commit/b408e4adf20dcccc3e96897eab5c18a80b9f1c3d)]
- ⚡ Adds caching to the `ClipartController` [[3002a9c](https://github.com/skyunlimitedinc/ays/commit/3002a9c14d14505f5c7bb957b8b24dedf6706e61)]

### Fixed

- 💚 Updates exclusions during rsync [[d860b92](https://github.com/skyunlimitedinc/ays/commit/d860b92f75c7622d527fc54184c382056c98feed)]
- 🐛 Forgot to return the Clipart Subcategories [[77dd779](https://github.com/skyunlimitedinc/ays/commit/77dd779087d1f6098f31d665a730230f9adcbc07)]

### Miscellaneous

- 🔨 Updates the docker compose file to the 'master' version [[5e2e7ce](https://github.com/skyunlimitedinc/ays/commit/5e2e7ce26ed4ee8ec9ac55161141a53e31847038)]


<a name="2020.9.2"></a>
## 2020.9.2 (2021-02-17)

### Added

- ➕ Replaces deprecated faker library with FakerPHP [[e9d25f8](https://github.com/skyunlimitedinc/ays/commit/e9d25f89954022ea7e082f3e3a4cd7acba94966f)]

### Changed

- 👽 Replaces sample factory with new L8 version [[d7dcab3](https://github.com/skyunlimitedinc/ays/commit/d7dcab39a4c1647608be22f447f3ebcc882ee61e)]
- 👽 Namespaces factories and seeders [[b55c361](https://github.com/skyunlimitedinc/ays/commit/b55c36146a9a4201bb38bdcf21208a5054bf6836)]
- ⬆️ Updates to Laravel 8.0 [[e1c18a9](https://github.com/skyunlimitedinc/ays/commit/e1c18a978c89b29c4e21b5189b0471dcc46a7323)]

### Miscellaneous

- 🩹 Let the Docker image use Composer 2 [[7a5910f](https://github.com/skyunlimitedinc/ays/commit/7a5910f65fcd1c829dfb459d766cc037790aebc2)]


<a name="2020.9.1"></a>
## 2020.9.1 (2021-02-17)

### Changed

- ⬆️ Updates to Laravel 7.0 [[82865b5](https://github.com/skyunlimitedinc/ays/commit/82865b5f09e0388df738fa8862590f1c29d68726)]

### Fixed

- 💚 Removes the Composer downgrade from CI [[43668c4](https://github.com/skyunlimitedinc/ays/commit/43668c4a164b48fa544f988570d826df86e6fbbf)]
- 💚 Sets Travis to use Composer v1 [[34e181a](https://github.com/skyunlimitedinc/ays/commit/34e181ad55250632079cc435a8a9b918c9a7c3a2)]
- 💚 Fixes PHP version number for Travis [[cd7f196](https://github.com/skyunlimitedinc/ays/commit/cd7f196b451d37bcb6f5a5234abb5c9aca6c841e)]


<a name="2020.9.0"></a>
## 2020.9.0 (2021-02-17)

### Changed

- ⬆️ Updates to Laravel 6.0 [[4b6913d](https://github.com/skyunlimitedinc/ays/commit/4b6913d2f90bbb7a5f07705752d3cc24f86f74b0)]
- ⬆️ Updates Composer dependencies for Laravel 5.8 [[eec6390](https://github.com/skyunlimitedinc/ays/commit/eec6390a9e01533a605acb02c5d6c3a0d30b308d)]
- 🔧 Configures PhpStorm to behave better [[1d24d3a](https://github.com/skyunlimitedinc/ays/commit/1d24d3a35ddcfad5a5d080cb167de5e5ccf0ac1f)]
- 🔧 JetBrains config files updated [[a1dc048](https://github.com/skyunlimitedinc/ays/commit/a1dc048018d88ff7f8d6a7b86250b35ef47071be)]

### Removed

- 🔥 Removes old and unnecessary dev scripts [[c08a6a4](https://github.com/skyunlimitedinc/ays/commit/c08a6a44cd5c6100d995ef5ec4e9fcf50c618989)]

### Miscellaneous

- 🔨 Runs the PhpStorm IDE Helper [[4628d9c](https://github.com/skyunlimitedinc/ays/commit/4628d9c6b86022e3e6af0dd9a8dfc711881647e7)]
- 🔨 Updates Docker build script and tweaks port numbers [[ecb51f4](https://github.com/skyunlimitedinc/ays/commit/ecb51f4dc205d907ff71ff5761bfb2945ab29db9)]
- 🔨 Adds project info to `package.json` [[cdd5843](https://github.com/skyunlimitedinc/ays/commit/cdd5843c91a9cf87f1c6678ed4aaf5745089be71)]
- 🙈 Updates .gitignore to modern settings [[a981d25](https://github.com/skyunlimitedinc/ays/commit/a981d258414ac01af573ab870501cd2bca5f94f3)]

<a name="The Before Times"></a>
## The Before Times

-  README fix [[42e6463](https://github.com/skyunlimitedinc/ays/commit/42e646305cc2d4e8d5617338906d04bf17b65391)]
-  README Build Status [[f2ccbcd](https://github.com/skyunlimitedinc/ays/commit/f2ccbcd790a6c7296e99f8c8b97f6a88311f9de2)]
-  config:clear [[954fa2f](https://github.com/skyunlimitedinc/ays/commit/954fa2f7b310dc95a50772132513f9c945faf644)]
-  Revert "Remove Linking Temporarily" [[f3649fa](https://github.com/skyunlimitedinc/ays/commit/f3649fa567c899a02a9bf896770084005fa59e89)]
-  Remove Linking Temporarily [[b8ee2d1](https://github.com/skyunlimitedinc/ays/commit/b8ee2d18d5e28ba3cf2a245e6f0b7e2f561f5eee)]
-  Manual Storage Link [[0456a41](https://github.com/skyunlimitedinc/ays/commit/0456a41e8722e7167ead38dc4f1d22bda80f2424)]
-  Skip Skip Cleanup [[d9969af](https://github.com/skyunlimitedinc/ays/commit/d9969af84f17465a8a35a62bf562d05dcaa698a1)]
-  Skip Cleanup [[23f7fe9](https://github.com/skyunlimitedinc/ays/commit/23f7fe98b44e3f06047ffce6f5defa7dbd18330f)]
-  Double Quotes [[c219227](https://github.com/skyunlimitedinc/ays/commit/c219227e4955a23735ab79a58bb7b898be12bddc)]
-  Ansible Provisioning [[0370423](https://github.com/skyunlimitedinc/ays/commit/037042314176cbe56703285fcf85c7bccb60841e)]
-  rsync -aO [[a81a927](https://github.com/skyunlimitedinc/ays/commit/a81a9279198f43f70055cee6c60a111393e70e06)]
-  rsync -a [[cf33b8b](https://github.com/skyunlimitedinc/ays/commit/cf33b8b3a87d6a2a6c2da5f27316d5d01e4c9a96)]
-  rsync [[743ef1b](https://github.com/skyunlimitedinc/ays/commit/743ef1b891792048cc2cb36d6f16589bde762523)]
-  'Add' Location [[d50d45c](https://github.com/skyunlimitedinc/ays/commit/d50d45c5ed2ec4f8a1453a48eaf3f1dbcd29566c)]
-  Reattach HEAD [[84ddd01](https://github.com/skyunlimitedinc/ays/commit/84ddd01605c636471a951fd807d32c96ed864260)]
-  Skip Script? [[9c6b150](https://github.com/skyunlimitedinc/ays/commit/9c6b150c630cec58ee7c37e0e210d9f04770308c)]
-  Removes NVM [[8f500d7](https://github.com/skyunlimitedinc/ays/commit/8f500d7abdb824e8d69bb6ef0711651549391682)]
-  Xenial-php7.2 [[62a45e4](https://github.com/skyunlimitedinc/ays/commit/62a45e4fd64c28f755f817c740a4c39692bec32b)]
-  Travis [[8165de5](https://github.com/skyunlimitedinc/ays/commit/8165de546ab9180591f9253404364130ce18aaba)]
-  August 2020 Fixes [[119e924](https://github.com/skyunlimitedinc/ays/commit/119e924776bf8cf1def89b4e5424d14c6c2da39d)]
-  Images [[1dfe3c0](https://github.com/skyunlimitedinc/ays/commit/1dfe3c0d2a6f50245ec54bf18fd5854e3fb4dffc)]
-  Don't Ignore Storage [[ee7e657](https://github.com/skyunlimitedinc/ays/commit/ee7e657020b809efd97f392e4af1dec3eb44392a)]
-  Merge branch 'dockerize' [[c17d660](https://github.com/skyunlimitedinc/ays/commit/c17d66084c08eb2d970af9759c05fceeea31b2d5)]
-  Workspace [[edd16c1](https://github.com/skyunlimitedinc/ays/commit/edd16c1d27c90954bd2ad7d720cccc4c0b0388ad)]
-  Workspace [[75b1a66](https://github.com/skyunlimitedinc/ays/commit/75b1a66de2d3c0e8778d7ef8097ed638f293837e)]
-  HAProxy [[94d68fe](https://github.com/skyunlimitedinc/ays/commit/94d68feec5f81294cf5335196f70728d41a6338c)]
-  A bunch of .idea files changed [[4f8d78c](https://github.com/skyunlimitedinc/ays/commit/4f8d78c092e82344445ee786470224c0afbdbe19)]
-  Sort Thumbnails [[cbdcf67](https://github.com/skyunlimitedinc/ays/commit/cbdcf6715069ceecf1991f3005bec690ab6d26b3)]
-  First attempt at dockerizing AYS [[bac5348](https://github.com/skyunlimitedinc/ays/commit/bac534822bbd9ed8129b33f143d69ae98a98677a)]
-  Hide Catalog [[71dc492](https://github.com/skyunlimitedinc/ays/commit/71dc492435c50b4de3f69fd95146180d4737e21b)]
-  AYS 2020 [[2c34c13](https://github.com/skyunlimitedinc/ays/commit/2c34c13346410a123c1bf760e963eaf64f630c24)]
-  Submodule Re-add [[9723669](https://github.com/skyunlimitedinc/ays/commit/9723669a2eb04f221dbf0aeafc1f29f4d198ed67)]
-  Removing a non-submodule [[3f8af63](https://github.com/skyunlimitedinc/ays/commit/3f8af63fb7a65459d0f13b51fdff4a3308d1c00a)]
-  Initial re-commit [[0b1a098](https://github.com/skyunlimitedinc/ays/commit/0b1a0980b3f624b224b62a074f66f3896d3b21f6)]


