# Changelog

<a name="2020.10.0"></a>
## 2020.10.0 (2021-02-18)

### Added

- 👷‍♂️ Save some time during artisan commands [[708dd49](https://github.com/skyunlimitedinc/ays/commit/708dd49109d923f33735b2e58b6e19207b5c51af)]
- 👷‍♂️ Set deployment to run from two branches [[3ae0f51](https://github.com/skyunlimitedinc/ays/commit/3ae0f511f6bbd26110b4c76411240bfb5eab82b9)]
- ➕ Adds ext-pdo for updating the database config [[d11007d](https://github.com/skyunlimitedinc/ays/commit/d11007da7b240abb29a5085b40fc27da68e4a595)]

### Changed

- 🚨 Lints the deployment shell script [[c6385d5](https://github.com/skyunlimitedinc/ays/commit/c6385d51d30d20dff05b7c1870a1b967256a00d9)]
- 🔧 Configures PhpRedis and sets it to be used for caching [[40cd91d](https://github.com/skyunlimitedinc/ays/commit/40cd91d8f7adbf98856c54b09ed0fb623368fe82)]
- ⚡ Adds caching to the `ProductController` [[cb34ff8](https://github.com/skyunlimitedinc/ays/commit/cb34ff88942309441e3f599dff17a55ca5ca7100)]
- 🎨 Prettifies `ProductController` [[bc20954](https://github.com/skyunlimitedinc/ays/commit/bc209545ec323b177434735e71ec50890f47ba0a)]
- ⚡ Adds caching to the `ClipartController` [[eeb473f](https://github.com/skyunlimitedinc/ays/commit/eeb473f77a7145e7a61ba5675fff6b55b56e955a)]

### Fixed

- 💚 Updates exclusions during rsync [[26ddee9](https://github.com/skyunlimitedinc/ays/commit/26ddee9af368fcc27535aea670b5455100549056)]
- 🐛 Forgot to return the Clipart Subcategories [[6b0c5c4](https://github.com/skyunlimitedinc/ays/commit/6b0c5c4a9bedc6fc6fc1597fc49d85b544682a00)]

### Miscellaneous

- 🔨 Updates the docker compose file to the 'master' version [[65188b5](https://github.com/skyunlimitedinc/ays/commit/65188b5a7f67363e3074138dbb2357c0d3c1f35c)]


<a name="2020.9.2"></a>
## 2020.9.2 (2021-02-17)

### Added

- ➕ Replaces deprecated faker library with FakerPHP [[d7c8cad](https://github.com/skyunlimitedinc/ays/commit/d7c8cad8bc55f53b659c17855062a435e81f08cd)]

### Changed

- 👽 Replaces sample factory with new L8 version [[3c3b285](https://github.com/skyunlimitedinc/ays/commit/3c3b285403cfcdb751bb69cbd5fb5fb804a00888)]
- 👽 Namespaces factories and seeders [[22872e4](https://github.com/skyunlimitedinc/ays/commit/22872e4d7a63898852d327bf782da5c20f23ed7d)]
- ⬆️ Updates to Laravel 8.0 [[088c3b6](https://github.com/skyunlimitedinc/ays/commit/088c3b6e9216c9f973364d480086ae1aec7ab3ba)]

### Miscellaneous

- 🩹 Let the Docker image use Composer 2 [[7a457a7](https://github.com/skyunlimitedinc/ays/commit/7a457a773dfd1dcce5cb9b97d5e48ee6b884ad84)]


<a name="2020.9.1"></a>
## 2020.9.1 (2021-02-17)

### Changed

- ⬆️ Updates to Laravel 7.0 [[512e3a5](https://github.com/skyunlimitedinc/ays/commit/512e3a57bc73a06bd72638b265beac6627df7879)]

### Fixed

- 💚 Removes the Composer downgrade from CI [[1d044be](https://github.com/skyunlimitedinc/ays/commit/1d044becd06f1ab115a62dd0d254e301c362be5b)]
- 💚 Sets Travis to use Composer v1 [[cba6495](https://github.com/skyunlimitedinc/ays/commit/cba649573a747276a06d1000b735a54ff929997b)]
- 💚 Fixes PHP version number for Travis [[07f4eae](https://github.com/skyunlimitedinc/ays/commit/07f4eaeba3aadc3fc159dc91475874993c3f72a4)]


<a name="2020.9.0"></a>
## 2020.9.0 (2021-02-17)

### Changed

- ⬆️ Updates to Laravel 6.0 [[ce093ad](https://github.com/skyunlimitedinc/ays/commit/ce093addf298ecc27f0ab488df485d894a12afd2)]
- ⬆️ Updates Composer dependencies for Laravel 5.8 [[99841f3](https://github.com/skyunlimitedinc/ays/commit/99841f315e3bf6a7daf5dc87f06c21f5c6be61b0)]
- 🔧 Configures PhpStorm to behave better [[d2628ba](https://github.com/skyunlimitedinc/ays/commit/d2628bac402f65fd6bb96ee07e229db0f719a080)]
- 🔧 JetBrains config files updated [[f2e4594](https://github.com/skyunlimitedinc/ays/commit/f2e459498565570a0f166e024a93a71fa9595d21)]

### Removed

- 🔥 Removes old and unnecessary dev scripts [[a01c16d](https://github.com/skyunlimitedinc/ays/commit/a01c16da2106403cce45cef55c8f66fa698376b5)]

### Miscellaneous

- 🔨 Runs the PhpStorm IDE Helper [[0a53e93](https://github.com/skyunlimitedinc/ays/commit/0a53e9381458fb2826139205eb2c788f90e1a74a)]
- 🔨 Updates Docker build script and tweaks port numbers [[f7a6d87](https://github.com/skyunlimitedinc/ays/commit/f7a6d87e87ed56b5c6095a30337c442a24c56e45)]
- 🔨 Adds project info to `package.json` [[32ec431](https://github.com/skyunlimitedinc/ays/commit/32ec431a11dbc29073f0cda3177d46aa6937fce0)]
- 🙈 Updates .gitignore to modern settings [[c41d071](https://github.com/skyunlimitedinc/ays/commit/c41d0715539c0f910b6ee5d2ce164a7d08edb46b)]

<a name="The Before Times"></a>
## The Before Times

-  README fix [[67231eb](https://github.com/skyunlimitedinc/ays/commit/67231eb8fd0b1cf5492b5b468b4b495059160ca4)]
-  README Build Status [[f24eb18](https://github.com/skyunlimitedinc/ays/commit/f24eb18df71d03e6b4a463134a7d19a04799daec)]
-  config:clear [[8e04c7d](https://github.com/skyunlimitedinc/ays/commit/8e04c7d50a3948f41594db3adbe0638a05fcd87f)]
-  Revert "Remove Linking Temporarily" [[6cca43e](https://github.com/skyunlimitedinc/ays/commit/6cca43e6c6931d4a6397ac01a32c5c8cdfd69b33)]
-  Remove Linking Temporarily [[d010c5f](https://github.com/skyunlimitedinc/ays/commit/d010c5fc76886765fbed391a2321df944c1aed7f)]
-  Manual Storage Link [[20f53a2](https://github.com/skyunlimitedinc/ays/commit/20f53a2c9774ec9ff93f3a650619592793026d3d)]
-  Skip Skip Cleanup [[5101025](https://github.com/skyunlimitedinc/ays/commit/5101025b317343fa64a40877fd4552ee6fb5a8ac)]
-  Skip Cleanup [[0a5f9aa](https://github.com/skyunlimitedinc/ays/commit/0a5f9aa4a2477f9c8857d9bf5f4173e0c0ced720)]
-  Double Quotes [[e0bcd55](https://github.com/skyunlimitedinc/ays/commit/e0bcd55b9c062fc9d3e1b4e1fb2440c45a47571b)]
-  Ansible Provisioning [[5165594](https://github.com/skyunlimitedinc/ays/commit/5165594a7cabe15ce77242096e2f28ba95b6e1f0)]
-  rsync -aO [[94ac125](https://github.com/skyunlimitedinc/ays/commit/94ac12581f5d03e4a3adb482c8a32c165bd021c4)]
-  rsync -a [[a572674](https://github.com/skyunlimitedinc/ays/commit/a57267430ce642b40b81ce77461163ff09b2f336)]
-  rsync [[6dc3c25](https://github.com/skyunlimitedinc/ays/commit/6dc3c25a796ff1a52d23e7a8cb1824461932a4dd)]
-  'Add' Location [[fa31d4b](https://github.com/skyunlimitedinc/ays/commit/fa31d4b14b28f078c555ffc95c866f8196c0a0b2)]
-  Reattach HEAD [[1dd78a6](https://github.com/skyunlimitedinc/ays/commit/1dd78a6fba18bf11658cf4970c390ae32db971ab)]
-  Skip Script? [[0eba718](https://github.com/skyunlimitedinc/ays/commit/0eba718eafd65d2a1016c3cd9c87fe2f6410548b)]
-  Removes NVM [[dd8e7c5](https://github.com/skyunlimitedinc/ays/commit/dd8e7c5ae70d67547c139c0c2eebdd767c05447e)]
-  Xenial-php7.2 [[0a44adb](https://github.com/skyunlimitedinc/ays/commit/0a44adb233c94c12c5b2d12e98ba501b053ee659)]
-  Travis [[3f98605](https://github.com/skyunlimitedinc/ays/commit/3f98605dce5db9d790bcd8987ff96d389fa6cb50)]
-  August 2020 Fixes [[4b12145](https://github.com/skyunlimitedinc/ays/commit/4b121452b264568eac05aa00bcc9503ac05f5d9a)]
-  Images [[551b0c0](https://github.com/skyunlimitedinc/ays/commit/551b0c00b7663b4b922ae177b1abfc7b64f4eb95)]
-  Don't Ignore Storage [[68fae6d](https://github.com/skyunlimitedinc/ays/commit/68fae6d563e6b655e475e04c8217e1ab2e6c2e2d)]
-  Merge branch 'dockerize' [[a63defd](https://github.com/skyunlimitedinc/ays/commit/a63defdf2c3692efda8ad138f5354b5f3468d805)]
-  Workspace [[edd16c1](https://github.com/skyunlimitedinc/ays/commit/edd16c1d27c90954bd2ad7d720cccc4c0b0388ad)]
-  Workspace [[1c19c2d](https://github.com/skyunlimitedinc/ays/commit/1c19c2dec92ce6b6acef92693ca808ae8a9db050)]
-  HAProxy [[e28df7e](https://github.com/skyunlimitedinc/ays/commit/e28df7ee79d2e562aed287245cc55f026d9f62a6)]
-  A bunch of .idea files changed [[7bb1dcf](https://github.com/skyunlimitedinc/ays/commit/7bb1dcf708110696d852f083031e511418a6d4a0)]
-  Sort Thumbnails [[83ff32d](https://github.com/skyunlimitedinc/ays/commit/83ff32d9072ca446870d7eb572d2d295fcccf55e)]
-  First attempt at dockerizing AYS [[bac5348](https://github.com/skyunlimitedinc/ays/commit/bac534822bbd9ed8129b33f143d69ae98a98677a)]
-  Hide Catalog [[71dc492](https://github.com/skyunlimitedinc/ays/commit/71dc492435c50b4de3f69fd95146180d4737e21b)]
-  AYS 2020 [[2c34c13](https://github.com/skyunlimitedinc/ays/commit/2c34c13346410a123c1bf760e963eaf64f630c24)]
-  Submodule Re-add [[9723669](https://github.com/skyunlimitedinc/ays/commit/9723669a2eb04f221dbf0aeafc1f29f4d198ed67)]
-  Removing a non-submodule [[3f8af63](https://github.com/skyunlimitedinc/ays/commit/3f8af63fb7a65459d0f13b51fdff4a3308d1c00a)]
-  Initial re-commit [[0b1a098](https://github.com/skyunlimitedinc/ays/commit/0b1a0980b3f624b224b62a074f66f3896d3b21f6)]


