{{-- Datos del CV: usar \App\Helpers\CvTemplateHelper::data($user, $forPdf) --}}
@php extract(\App\Helpers\CvTemplateHelper::data($user, !empty($forPdf))); @endphp
