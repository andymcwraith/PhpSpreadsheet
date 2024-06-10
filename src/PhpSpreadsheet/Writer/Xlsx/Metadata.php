<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Namespaces;
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;

class Metadata extends WriterPart
{
    /**
     * Write content types to XML format.
     *
     * @return string XML Output
     */
    public function writeMetadata(): string
    {
        // Create XML writer
        $objWriter = null;
        if ($this->getParentWriter()->getUseDiskCaching()) {
            $objWriter = new XMLWriter(XMLWriter::STORAGE_DISK, $this->getParentWriter()->getDiskCachingDirectory());
        } else {
            $objWriter = new XMLWriter(XMLWriter::STORAGE_MEMORY);
        }

        // XML header
        $objWriter->startDocument('1.0', 'UTF-8', 'yes');

        // Types
        $objWriter->startElement('metadata');
        $objWriter->writeAttribute('xmlns', Namespaces::MAIN);
        $objWriter->writeAttribute('xmlns:xda', Namespaces::DYNAMIC_ARRAY);

        $objWriter->startElement('metadataTypes');
        $objWriter->writeAttribute('count', '1');
        $objWriter->startElement('metadataType');
        $objWriter->writeAttribute('name', 'XLDAPR');
        $objWriter->writeAttribute('minSupportedVersion', '120000');
        $objWriter->writeAttribute('copy', '1');
        $objWriter->writeAttribute('pasteAll', '1');
        $objWriter->writeAttribute('pasteValues', '1');
        $objWriter->writeAttribute('merge', '1');
        $objWriter->writeAttribute('splitFirst', '1');
        $objWriter->writeAttribute('rowColShift', '1');
        $objWriter->writeAttribute('clearFormats', '1');
        $objWriter->writeAttribute('clearComments', '1');
        $objWriter->writeAttribute('assign', '1');
        $objWriter->writeAttribute('coerce', '1');
        $objWriter->writeAttribute('cellMeta', '1');
        $objWriter->endElement(); // metadataType
        $objWriter->endElement(); // metadataTypes

        $objWriter->startElement('futureMetadata');
        $objWriter->writeAttribute('name', 'XLDAPR');
        $objWriter->writeAttribute('count', '1');
        $objWriter->startElement('bk');
        $objWriter->startElement('extLst');
        $objWriter->startElement('ext');
        $objWriter->writeAttribute('uri', '{bdbb8cdc-fa1e-496e-a857-3c3f30c029c3}');
        $objWriter->startElement('xda:dynamicArrayProperties');
        $objWriter->writeAttribute('fDynamic', '1');
        $objWriter->writeAttribute('fCollapsed', '0');
        $objWriter->endElement(); // xda:dynamicArrayProperties
        $objWriter->endElement(); // ext
        $objWriter->endElement(); // extLst
        $objWriter->endElement(); // bk
        $objWriter->endElement(); // futureMetadata

        $objWriter->startElement('cellMetadata');
        $objWriter->writeAttribute('count', '1');
        $objWriter->startElement('bk');
        $objWriter->startElement('rc');
        $objWriter->writeAttribute('t', '1');
        $objWriter->writeAttribute('v', '0');
        $objWriter->endElement(); // rc
        $objWriter->endElement(); // bk
        $objWriter->endElement(); // cellMetadata

        $objWriter->endElement(); // metadata

        // Return
        return $objWriter->getData();
    }
}
