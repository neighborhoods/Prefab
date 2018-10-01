<?php

namespace Neighborhoods\Prefab\CodeGen;

use Zend\Code\Generator\FileGenerator as ZendFileGenerator;

class FileGenerator extends ZendFileGenerator
{
    public function generate()
    {
        if ($this->isSourceDirty() === false) {
            return $this->sourceContent;
        }

        $output = '';

        // @note body gets populated when FileGenerator created
        // from a file.  @see fromReflection and may also be set
        // via FileGenerator::setBody
        $body = $this->getBody();

        // start with the body (if there), or open tag
        if (preg_match('#(?:\s*)<\?php#', $body) == false) {
            $output = '<?php' . self::LINE_FEED;
        }

        // if there are markers, put the body into the output
        if (preg_match('#/\* Zend_Code_Generator_Php_File-(.*?)Marker:#m', $body)) {
            $tokens = token_get_all($body);
            foreach ($tokens as $token) {
                if (is_array($token) && in_array($token[0], [T_OPEN_TAG, T_COMMENT, T_DOC_COMMENT, T_WHITESPACE])) {
                    $output .= $token[1];
                }
            }
            $body = '';
        }

        // Add file DocBlock, if any
        if (null !== ($docBlock = $this->getDocBlock())) {
            $docBlock->setIndentation('');

            if (preg_match('#/\* Zend_Code_Generator_FileGenerator-DocBlockMarker \*/#m', $output)) {
                // @codingStandardsIgnoreStart
                $output = preg_replace('#/\* Zend_Code_Generator_FileGenerator-DocBlockMarker \*/#m', $docBlock->generate(), $output, 1);
                // @codingStandardsIgnoreEnd
            } else {
                $output .= $docBlock->generate() . self::LINE_FEED;
            }
        }

        // newline
        $output .= self::LINE_FEED;

        // namespace, if any
        $namespace = $this->getNamespace();
        if ($namespace) {
            $namespace = sprintf('namespace %s;%s', $namespace, str_repeat(self::LINE_FEED, 2));
            if (preg_match('#/\* Zend_Code_Generator_FileGenerator-NamespaceMarker \*/#m', $output)) {
                $output = preg_replace(
                    '#/\* Zend_Code_Generator_FileGenerator-NamespaceMarker \*/#m',
                    $namespace,
                    $output,
                    1
                );
            } else {
                $output .= $namespace;
            }
        }

        // process required files
        // @todo marker replacement for required files
        $requiredFiles = $this->getRequiredFiles();
        if (! empty($requiredFiles)) {
            foreach ($requiredFiles as $requiredFile) {
                $output .= 'require_once \'' . $requiredFile . '\';' . self::LINE_FEED;
            }

            $output .= self::LINE_FEED;
        }

        $classes = $this->getClasses();
        $classUses = [];
        //build uses array
        foreach ($classes as $class) {
            //check for duplicate use statements
            $uses = $class->getUses();
            if (! empty($uses) && is_array($uses)) {
                $classUses = array_merge($classUses, $uses);
            }
        }

        // process import statements
        $uses = $this->getUses();
        if (! empty($uses)) {
            $useOutput = '';

            foreach ($uses as $use) {
                list($import, $alias) = $use;
                if (null === $alias) {
                    $tempOutput = sprintf('%s', $import);
                } else {
                    $tempOutput = sprintf('%s as %s', $import, $alias);
                }

                //don't duplicate use statements
                if (! in_array($tempOutput, $classUses)) {
                    $useOutput .= 'use ' . $tempOutput . ';';
                    $useOutput .= self::LINE_FEED;
                }
            }
            $useOutput .= self::LINE_FEED;

            if (preg_match('#/\* Zend_Code_Generator_FileGenerator-UseMarker \*/#m', $output)) {
                $output = preg_replace(
                    '#/\* Zend_Code_Generator_FileGenerator-UseMarker \*/#m',
                    $useOutput,
                    $output,
                    1
                );
            } else {
                $output .= $useOutput;
            }
        }

        // process classes
        if (! empty($classes)) {
            foreach ($classes as $class) {
                $output = substr_replace($output, "declare(strict_types=1);\n", 6, 0);

                // @codingStandardsIgnoreStart
                $regex = str_replace('&', $class->getName(), '/\* Zend_Code_Generator_Php_File-ClassMarker: \{[A-Za-z0-9\\\]+?&\} \*/');
                // @codingStandardsIgnoreEnd
                if (preg_match('#' . $regex . '#m', $output)) {
                    $output = preg_replace('#' . $regex . '#', $class->generate(), $output, 1);
                } else {
                    if ($namespace) {
                        $class->setNamespaceName(null);
                    }
                    $output .= $class->generate() . self::LINE_FEED;
                }
            }
        }

        if (! empty($body)) {
            // add an extra space between classes and
            if (! empty($classes)) {
                $output .= self::LINE_FEED;
            }

            $output .= $body;
        }

        return $output;
    }
}
