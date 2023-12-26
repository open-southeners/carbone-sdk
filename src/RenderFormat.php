<?php

namespace OpenSoutheners\CarboneSdk;

/**
 * @see https://carbone.io/documentation.html#supported-files-and-features-list
 */
enum RenderFormat: string
{
    case Xml = 'xml';

    case Html = 'html';

    case Pdf = 'pdf';

    case Odt = 'odt';

    case Doc = 'doc';

    case Docx = 'docx';

    case Txt = 'txt';

    case Jpg = 'jpg';

    case Png = 'png';

    case Epub = 'epub';

    case Ods = 'ods';

    case Xlsx = 'xlsx';

    case Xls = 'xls';

    case Csv = 'csv';

    case Odp = 'odp';

    case Ppt = 'ppt';

    case Pptx = 'pptx';

    case Idml = 'idml';
}
