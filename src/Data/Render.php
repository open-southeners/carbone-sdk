<?php

namespace OpenSoutheners\CarboneSdk\Data;

use OpenSoutheners\CarboneSdk\RenderFormat;

final class Render
{
    /**
     * @param  array  $data Data-set merged into the template to generate a document
     * @param  string|\OpenSoutheners\CarboneSdk\RenderFormat  $convertTo Convert the document into another format. List of supported formats: https://carbone.io/documentation.html#supported-files-and-features-list
     * @param  string|null  $timezone Convert document dates to a timezone. The default timezone is `Europe/Paris`. The date must be chained with the `:formatD` formatter, for instance `{d.date:formatD(YYYY-MM-DD HH:MM)}`
     * @param  string|null  $lang Locale of the generated doocument, it will used for translation `{t()}`, formatting numbers with `:formatN`, and currencies `:formatC`. List of supported locales: https://github.com/carboneio/carbone/blob/master/formatters/_locale.js
     * @param  array|null  $complement Extra data accessible in the template with {c.} instead of {d.}
     * @param  string|null  $variableStr Predefine alias, related documenation: https://carbone.io/documentation.html#alias
     * @param  string|null  $reportName Static or dynamic file name returned on the `content-disposition` header when the generated report is fetched with `GET /report/:renderId`. Multiple Carbone tags are accepted, such as `{d.type}-{d.date}.pdf`
     * @param  array|null  $enum List of enumerations, use it in reports with `convEnum` formatters, documentation: https://carbone.io/documentation.html#convenum-type-
     * @param  array|null  $translations When the report is generated, all text between `{t( )}` is replaced with the corresponding translation. The `lang` option is required to select the correct translation. Learn more: https://carbone.io/documentation.html#translations
     * @param  string|null  $currencySource Currency source coming from your JSON data. The option is used by `formatC` to convert the currency based on the `currencyTarget` and `currencyRates`. Learn more: https://carbone.io/documentation.html#formatc-precisionorformat-
     * @param  string|null  $currencyTarget Target currency when the document is generated. The option is used by `formatC` to convert the currency based on the `currencySource` and `currencyRates`. Learn more: https://carbone.io/documentation.html#formatc-precisionorformat-
     * @param  array|null  $currencyRates Currency exchange rates for conversions from `currencySource` to `currencyTarget`. Learn more: https://carbone.io/documentation.html#formatc-precisionorformat-
     * @param  bool|null  $hardRefresh If true, the report content is refreshed at the end of the rendering process. To use this option, `convertTo` has to be defined.
     */
    public function __construct(
        public readonly array $data,
        public readonly string|RenderFormat $convertTo = RenderFormat::Pdf,
        public readonly string|null $timezone = null,
        public readonly string|null $lang = null,
        public readonly array|null $complement = null,
        public readonly string|null $variableStr = null,
        public readonly string|null $reportName = null,
        public readonly array|null $enum = null,
        public readonly array|null $translations = null,
        public readonly string|null $currencySource = null,
        public readonly string|null $currencyTarget = null,
        public readonly array|null $currencyRates = null,
        public readonly bool|null $hardRefresh = null
    ) {
        //
    }

    public function getFormat(): string
    {
        return is_string($this->convertTo)
            ? $this->convertTo
            : $this->convertTo->value;
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'convertTo' => $this->getFormat(),
            'timezone' => $this->timezone,
            'lang' => $this->lang,
            'complement' => $this->complement,
            'variableStr' => $this->variableStr,
            'reportName' => $this->reportName,
            'enum' => $this->enum,
            'translations' => $this->translations,
            'currencySource' => $this->currencySource,
            'currencyTarget' => $this->currencyTarget,
            'currencyRates' => $this->currencyRates,
            'hardRefresh' => $this->hardRefresh,
        ];
    }
}
