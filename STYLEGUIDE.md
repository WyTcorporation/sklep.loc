# Style Guide

This project follows a set of conventions to keep code readable and consistent.

## Naming conventions

We use the [BEM](http://getbem.com/) methodology:

- **Blocks** represent standalone entities, e.g. `header`, `form`.
- **Elements** are parts of a block and use the `__` separator, e.g. `header__nav`.
- **Modifiers** change appearance or behavior and use the `--` separator, e.g. `header__link--active`.

### Example: Header

```html
<header class="header">
  <div class="header__logo"></div>
  <nav class="header__nav">
    <a class="header__link header__link--active" href="#">Home</a>
  </nav>
</header>
```

```scss
.header {
  &__logo { /* styles */ }
  &__nav { /* styles */ }
  &__link {
    &--active { /* styles */ }
  }
}
```

### Example: Form

```html
<form class="form">
  <div class="form__group">
    <label class="form__label" for="email">Email</label>
    <input class="form__input" id="email" />
  </div>
  <button class="form__submit">Send</button>
</form>
```

```scss
.form {
  &__group { /* styles */ }
  &__label { /* styles */ }
  &__input { /* styles */ }
  &__submit { /* styles */ }
}
```

## Folder structure

- `app/` – Laravel application code.
- `resources/`
  - `views/` – Blade templates and components.
  - `sass/` – SCSS partials for blocks and elements.
  - `js/` – JavaScript modules.
- `public/` – Compiled assets and entry point.

When adding a new component, place its template in `resources/views` and its styles in `resources/sass`. Keep file names consistent with the block name.

## Linting rules

CSS and SCSS are linted with [Stylelint](https://stylelint.io/). Configuration is stored in `.stylelintrc.json` and includes the `stylelint-scss` plugin.

Run linting before committing:

```bash
npm run lint:css
```

## Contributing

Follow this guide when naming classes, organizing files, and linting code to ensure a consistent codebase.
