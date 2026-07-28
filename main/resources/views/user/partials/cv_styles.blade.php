<style>
    .cv-doc {
        --cv-navy: #0b3a6e;
        --cv-blue: #2f6ea8;
        --cv-text: #5a6570;
        --cv-line: #2f6ea8;
        --cv-bg: #f7f8fa;
        max-width: 900px;
        margin: 0 auto;
        background: #fff;
        color: var(--cv-text);
        font-family: "DejaVu Sans", Arial, Helvetica, sans-serif;
        font-size: 12px;
        line-height: 1.45;
        border: 1px solid #e6e9ee;
    }

    .cv-doc * { box-sizing: border-box; }

    .cv-logos {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px 12px;
        background: #fff;
    }

    .cv-logos img {
        max-height: 56px;
        width: auto;
    }

    .cv-footer-bar {
        height: 18px;
        background: #f5a623;
    }

    .cv-hero {
        background: var(--cv-navy);
        color: #fff;
        text-align: center;
        padding: 22px 16px 18px;
    }

    .cv-hero h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #fff;
    }

    .cv-hero .cv-role {
        margin: 8px 0 0;
        font-size: 13px;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-weight: 400;
        color: #fff;
    }

    .cv-columns {
        display: flex;
        gap: 0;
        background: #fff;
        min-height: 640px;
    }

    .cv-left {
        width: 34%;
        padding: 24px 20px 28px;
        background: #fff;
        border-right: 1px solid #edf0f4;
    }

    .cv-right {
        width: 66%;
        padding: 24px 28px 28px;
        background: #fff;
    }

    .cv-section { margin-bottom: 22px; }

    .cv-section-title {
        margin: 0 0 8px;
        color: var(--cv-navy);
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .cv-section-title::after {
        content: "";
        display: block;
        width: 100%;
        height: 2px;
        background: var(--cv-line);
        margin-top: 6px;
    }

    .cv-left .cv-section-title::after {
        height: 1px;
    }

    .cv-text {
        margin: 0;
        color: var(--cv-text);
        text-align: justify;
    }

    .cv-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .cv-list li {
        position: relative;
        padding-left: 14px;
        margin-bottom: 6px;
        color: var(--cv-text);
    }

    .cv-list li::before {
        content: "-";
        position: absolute;
        left: 0;
        top: 0;
        color: var(--cv-text);
    }

    .cv-contact p {
        margin: 0 0 8px;
        color: var(--cv-text);
    }

    .cv-contact .label {
        font-weight: 700;
        color: #44505c;
    }

    .cv-item { margin-bottom: 18px; }

    .cv-item-title {
        margin: 0 0 2px;
        color: var(--cv-blue);
        font-size: 14px;
        font-weight: 700;
    }

    .cv-item-meta {
        margin: 0 0 8px;
        color: #7a8692;
        font-style: italic;
        font-size: 12px;
    }

    @media print {
        .cv-doc { border: none; max-width: none; }
        .cv-toolbar { display: none !important; }
    }
</style>
