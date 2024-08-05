# Description

Within this directory is found the configs for the various tools used for testing and linting the code.

## Recommendations
There is a recommended order to running the tools. This order is:
1. php-cs-fixer
2. php-parallel-lint
3. phpcbf
4. phpcs
5. phpmd

On Linux (or in Docker), you can simply use `make` to run them all. Run `make scan` from the project root in the terminal.

## [PHP Code Sniffer (phpcs)](https://github.com/PHPCSStandards/PHP_CodeSniffer/wiki)
**Purpose:** Linting and formatting code checks

**Usage Options:**

- Windows - from the project root directory in PowerShell (if PHP is installed and in the environment path)
  ```
  vendor\bin\phpcs --standard=build\phpcs\VirtualReef\ruleset.xml --report=full --colors -p classes tests config bootstrap
  ```
- Windows - from the project root directory in PowerShell (if PHP is installed and NOT in the environment path)
  ```
  <path\to\PHP\executable> vendor\bin\phpcs --standard=build\phpcs\VirtualReef\ruleset.xml --report=full --colors -p classes tests config bootstrap
  ```
- Linux - from the project root in the terminal
  ```
  make sniffer
  ```
  (or the same commands as Windows above are available)

## [PHP Code Beautifier and Fixer (phpcbf)](https://github.com/PHPCSStandards/PHP_CodeSniffer/wiki)
**Purpose:** Automatic resolution of simple non-breaking fixes identified by the same rules used by phpcs.

**Usage Options:**

- Windows - from the project root directory in PowerShell (if PHP is installed and in the environment path)
  ```
  vendor\bin\phpcbf --standard=build\phpcs\VirtualReef\ruleset.xml --report=full --colors -p classes tests config bootstrap
  ```
- Windows - from the project root directory in PowerShell (if PHP is installed and NOT in the environment path)
  ```
  <path\to\PHP\executable> vendor\bin\phpcbf --standard=build\phpcs\VirtualReef\ruleset.xml --report=full --colors -p classes tests config bootstrap
  ```
- Linux - from the project root in the terminal
  ```
  make sniffercbf
  ```
  (or the same commands as Windows above are available)

## [PHP Mess Detector (phpmd)](https://phpmd.org/about.html)
**Purpose:** Looks for and identifies potential problems with code. This is done after identifying a baseline, so will primarily analyze only new and/or updated code.

**Usage Options:**

- Windows - from the project root directory in PowerShell (if PHP is installed and in the environment path)
  ```
  vendor\bin\phpmd offline,classes,public ansi build\phpmd\phpmd.xml
  ```
- Windows - from the project root directory in PowerShell (if PHP is installed and NOT in the environment path)
  ```
  <path\to\PHP\executable> vendor\bin\phpmd offline,classes,public ansi build\phpmd\phpmd.xml
  ```
- Linux - from the project root in the terminal
  ```
  make phpmd
  ```
  (or the same commands as Windows above are available)

## [PHP Coding Standards Fixer (php-cs-fixer)](https://cs.symfony.com/)
**Purpose:** Makes non-breaking fixes to the code to follow standards defined by the project and to help reduce potential bugs.

**Usage Options:**

- Windows - from the project root directory in PowerShell (if PHP is installed and in the environment path)
  ```
  vendor\bin\php-cs-fixer fix --config=build\php-cs-fixer\php-cs-fixer.dist.php
  ```
- Windows - from the project root directory in PowerShell (if PHP is installed and NOT in the environment path)
  ```
  <path\to\PHP\executable> vendor\bin\php-cs-fixer fix --config=build\php-cs-fixer\php-cs-fixer.dist.php
  ```
- Linux - from the project root in the terminal
  ```
  make cs-fixer
  ```
  (or the same commands as Windows above are available)

## [PHP Parallel Lint (php-parallel-lint)](https://github.com/php-parallel-lint/PHP-Parallel-Lint)
**Purpose:** Checks for syntax errors in PHP files.

**Note:** There is no configuration for this in the build directory, but it works in parallel with the other tools mentioned, so it is mentioned here as well.

**Usage Options:**

- Windows - from the project root directory in PowerShell (if PHP is installed and in the environment path)
  ```
  vendor\bin\parallel-lint -j 10 offline classes tests public config bootstrap --no-progress --colors --blame
  ```
- Windows - from the project root directory in PowerShell (if PHP is installed and NOT in the environment path)
  ```
  <path\to\PHP\executable> vendor\bin\parallel-lint -j 10 offline classes tests public config bootstrap --no-progress --colors --blame
  ```
- Linux - from the project root in the terminal
  ```
  make lint
  ```
  (or the same commands as Windows above are available)
