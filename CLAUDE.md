# Wrestling App — CLAUDE.md

## What This Is

A wrestling news and database site. Editorial feel of **Voices of Wrestling** (analysis-driven, long-form), UI/UX of **WrestlingInc** (fast, news-forward, card-based), database philosophy of **Pitchfork** (hyperlinked entities — wrestlers, promotions, events, matches are first-class records you link to, not just text).

**Stack:** Laravel 11 · Blade · Alpine.js · Tailwind CSS 3 · SQLite · Vite

---

## Naming Conventions

### Routes & URLs
- Plural nouns for index pages: `/wrestlers`, `/articles`, `/bouts`, `/results`, `/promotions`
- Singular + ID for detail pages: `/wrestler/{wrestler}`, `/bout/{bout}`, `/event/{event}`, `/article-detail/{article}`, `/promotion/{promotion}`
- Action routes: `/add/wrestler`, `/wrestler/{wrestler}/edit`, `/wrestler/{wrestler}/delete`
- Named routes use dot notation: `wrestler.show`, `bout.show`, `event.show`, `articles.show`, `promotion.show`, `dashboard`

### PHP / Laravel
- Controllers: PascalCase, suffixed `Controller` — e.g. `WrestlerController`, `PostController`
- Models: singular PascalCase — `Wrestler`, `Bout`, `Article`, `Promotion`, `Event`, `Result`
- Helper functions: camelCase — `selectedPromotions()`, `promotionQuery()`, `formatCode()`
- Blade views: kebab-case — `article-detail.blade.php`, `add-wrestler.blade.php`
- Blade components: kebab-case, used as `<x-article-card>`, `<x-event-card>`, `<x-wrestler-card>`
- Sub-components use dot notation: `<x-card.header>`, `<x-card.body>`, `<x-card.footer>`
- Database columns: snake_case — `article_title`, `promotion_id`, `event_date`, `finish_type`, `winner_id`

### CSS
- BEM-style: `.article-card__title`, `.event-card-location`, `.tag--success`, `.btn--secondary`
- Component prefix matches blade component name: `article-card`, `event-card`, `wrestler-card`, `bout-card`, `result-card`
- List wrappers: `{noun}-list` — `.article-list`, `.event-list`, `.result-list`, `.wrestler-list`
- List items: `{noun}-list__item` or the component class itself (e.g. `.event-card` is both list item and component)
- Modifier classes: `--expanded`, `--secondary`, `--danger`, `--success`
- State classes: driven by Alpine.js `:class` bindings

### CSS Architecture
- One CSS file per component in `resources/css/components/{component-name}/style.css`
- Import each component file in `resources/css/app.css` (ordered: reset → typography → settings → setup → components)
- Global variables in `resources/css/settings.css` (CSS custom properties)
- Layout utilities in `resources/css/setup.css`
- Typography scale in `resources/css/typography.css`

### Typography Voice Scale
- `.attention-voice` — 2rem (page/section headlines)
- `.loud-voice` — 1.3rem (card titles, sub-headers)
- `.soft-voice` — 0.8rem (metadata, labels)
- `.quiet-voice` — 0.5rem (minor text)

### CSS Variables (from settings.css)
```
--blue, --blue-brand, --lightblue, --darkblue
--grey, --lightgrey, --img-grey, --xtra-lightgrey
--white, --black, --lightblack
--red, --lightred
--green, --lightgreen
--small-border-radius: 16px
--large-border-radius: 85px
--standard-padding: 10px
```

### Layout
- `<inner-column>` custom element = centered max-width (1400px) content wrapper with padding
- `.dashboard` = 3-column grid on desktop (1fr 2fr 1fr), stacks to 1 column on mobile (<1000px)
- `.wrestler-list` = 4-column grid

---

## Database Schema

| Table | Key Fields |
|-------|-----------|
| `promotions` | id, name |
| `wrestlers` | id, name, promotion_id |
| `articles` | id, article_title, content, promotion_id |
| `events` | id, name, promotion_id, event_date, venue, city, country, description |
| `bouts` | id, title, promotion_id, event_id |
| `bout_wrestlers` | id, wrestler_id, bout_id |
| `results` | id, bout_id, winner_id, finish_type, duration, notes |

**Key relationships:**
- Promotion → hasMany(Wrestler, Article, Event, Bout)
- Wrestler → belongsTo(Promotion), belongsToMany(Bout)
- Bout → belongsTo(Promotion), belongsTo(Event), hasOne(Result), belongsToMany(Wrestler)
- Event → belongsTo(Promotion), hasMany(Bout)
- Result → belongsTo(Bout), belongsTo(Wrestler via winner_id)

---

## Existing Pages

| Page | View | Route | Status |
|------|------|-------|--------|
| Dashboard | `dashboard.blade.php` | `/` or `/dashboard` | Working |
| Articles list | `articles.blade.php` | `/articles` | Working |
| Article detail | `article-detail.blade.php` | `/article-detail/{article}` | Working |
| Wrestlers list | `wrestlers.blade.php` | `/wrestlers` | Working |
| Wrestler detail | `wrestler.blade.php` | `/wrestler/{wrestler}` | Working |
| Add wrestler | `add-wrestler.blade.php` | `/add/wrestler` | Working |
| Edit wrestler | `edit-wrestler.blade.php` | `/wrestler/{wrestler}/edit` | Needs styling |
| Bouts list | `bouts.blade.php` | `/bouts` | Working |
| Bout detail | `bout.blade.php` | `/bout/{bout}` | Working |
| Results list | `results.blade.php` | `/results` | Working |
| Events detail | `event.blade.php` | `/event/{event}` | Working |
| Promotions list | `promotions.blade.php` | `/promotions` | Needs styling |
| Promotion detail | `promotion.blade.php` | `/promotion/{promotion}` | Working |
| Create article | `post/create.blade.php` | `/post/create` | Incomplete |

---

## What's Incomplete — Prioritized Roadmap

### Priority 1 — Content Authoring (Core missing feature)
- [ ] Complete `PostController@store` (currently uses `dd()`)
- [ ] Build proper article creation form (`post/create.blade.php`) with title, content (textarea), promotion selector, and submit
- [ ] Add `published_at` / `draft` status to articles table (migration needed)
- [ ] Add `slug` to articles for clean URLs (`/articles/{slug}` instead of `/article-detail/{id}`)
- [ ] Article edit/delete routes and views

### Priority 2 — Author / User System
- [ ] Add `author_id` FK to articles table → User (article blade references `$article->author->name` but no relation exists yet)
- [ ] Basic auth (Laravel Breeze or manual) — login/register for content editors
- [ ] Middleware to protect create/edit/delete routes

### Priority 3 — Schema & Data Gaps
- [ ] Add `image` field to wrestlers (currently placeholder URLs)
- [ ] Add `bio` / `height` / `weight` / `hometown` fields to wrestlers
- [ ] Add `image` / `logo` field to promotions
- [ ] Add `image` field to events
- [ ] Championships table: id, name, promotion_id, current_holder_id (wrestler_id), won_date
- [ ] Match type field on bouts (Singles, Tag Team, Triple Threat, Ladder, etc.)

### Priority 4 — UI Polish
- [ ] Style `promotions.blade.php` (currently an unstyled list) — use card grid like wrestlers page
- [ ] Style `edit-wrestler.blade.php` to match `add-wrestler.blade.php`
- [ ] Remove `border: 1px solid green` debug line from `app.css` (main element)
- [ ] Add footer component
- [ ] Add pagination to article list, wrestlers list, results list

### Priority 5 — Wrestler & Promotion Detail Pages
- [ ] Wrestler career stats: win/loss record derived from results table
- [ ] Wrestler match history list on wrestler detail page
- [ ] Promotion detail: championship listings, roster grid, recent events, recent articles

### Priority 6 — Discovery & Search
- [ ] Search bar in header (searches wrestlers, articles, events)
- [ ] Filter bouts by match type, event, promotion
- [ ] Filter articles by promotion (already on dashboard, needs to be on `/articles`)

### Priority 7 — Article Quality
- [ ] Add category/tag to articles (News, Review, Opinion, Results, Feature)
- [ ] Featured article flag for homepage hero
- [ ] Article rich text (currently plain textarea — consider simple markdown or basic HTML)

---

## Do Not Change
- The CSS variable names and voice scale classes — these are the design system foundation
- The `<inner-column>` custom element pattern
- BEM naming on existing components
- The promotion filter query string pattern (`promotions[]=1&promotions[]=2`) and `selectedPromotions()` helper
- The `x-layout` / `x-card` / `x-tag` component structure
- Route naming conventions
