<?php
// phpcs:ignorefile
declare(strict_types=1);

/**
 * Virtual Reef Coding Standard.
 *
 * @package WPCS\WordPressCodingStandards
 * @link    https://github.com/WordPress/WordPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace VirtualReefCS\VirtualReef\Sniffs\Files;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class FileExtensionSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array<int|string>
     */
    final public function register(): array
    {
        return [T_OPEN_TAG];

    }
    // end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in the
     *                                               stack passed in $tokens.
     *
     * @return int
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $fileNameParts = explode(DIRECTORY_SEPARATOR, $phpcsFile->getFilename());
        $fileName = end($fileNameParts);
        $extension  = strrchr( $fileName, '.' );
        $nextClass = $phpcsFile->findNext([T_CLASS], $stackPtr);
        $nextEnum = $phpcsFile->findNext([T_ENUM], $stackPtr);
        $nextTrait = $phpcsFile->findNext([T_TRAIT], $stackPtr);

        if ($nextClass !== false) {
            $classNamePos = $phpcsFile->findNext(T_STRING, $nextClass);
            $className = trim($tokens[$classNamePos]['content']);
            $expected = 'class.' . strtolower($className) . $extension;

            if ($fileName === $expected) {
                return;
            }

            $phpcsFile->addError(
                'Class file names should be based on the class name with "class." prepended. Expected %s, but found %s.',
                $stackPtr,
                'InvalidClassFileName',
                [
                    $expected,
                    $fileName,
                ]
            );
        } elseif ($nextEnum !== false) {
            $classNamePos = $phpcsFile->findNext(T_STRING, $nextEnum);
            $className = trim($tokens[$classNamePos]['content']);
            $expected = 'enum.' . strtolower($className) . $extension;

            if ($fileName === $expected) {
                return;
            }

            $phpcsFile->addError(
                'Enum file names should be based on the enum name with "enum." prepended. Expected %s, but found %s.',
                $stackPtr,
                'InvalidEnumFileName',
                [
                    $expected,
                    $fileName,
                ]
            );
        } elseif ($nextTrait !== false) {
            $classNamePos = $phpcsFile->findNext(T_STRING, $nextTrait);
            $className = trim($tokens[$classNamePos]['content']);
            $expected   = 'trait.' . strtolower($className) . $extension;

            if ( $fileName === $expected ) {
                return;
            }

            $phpcsFile->addError(
                'Trait file names should be based on the trait name with "trait." prepended. Expected %s, but found %s.',
                $stackPtr,
                'InvalidTraitFileName',
                [
                    $expected,
                    $fileName,
                ]
            );
        }

        // Ignore the rest of the file.
        return $phpcsFile->numTokens;

    }//end process()
}
