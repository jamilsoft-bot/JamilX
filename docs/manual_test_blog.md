# Manual Test Plan — Blog Service

## Public Routes
1. **Blog Home**: Visit `/blog` and verify the post list renders with pagination and empty-state messaging when no posts exist.
2. **Single Post**: Visit `/blog/post/{slug}` and confirm the post content, tags, related posts, and subscribe form render correctly.
3. **Categories List**: Visit `/blog/category` and confirm all categories display.
4. **Category Posts**: Visit `/blog/category/{slug}` and verify the filtered list, pagination, and empty state.
5. **Tags List**: Visit `/blog/tag` and confirm all tags display.
6. **Tag Posts**: Visit `/blog/tag/{slug}` and verify the filtered list, pagination, and empty state.
7. **Search**: Visit `/blog/search?q=keyword` and confirm results and pagination.
8. **Subscribe**: Submit the subscribe form and confirm the success/error message appears.

## Admin Routes (Requires Admin Session)
1. **Dashboard**: Visit `/admin/blog` and confirm stats, post list, and pagination.
2. **Create Post**: Visit `/admin/blog/new`, create a post, and verify redirect to edit screen with success message.
3. **Edit Post**: Visit `/admin/blog/edit/{id}`, update content, tags, or status, and confirm changes are saved.
4. **Delete Post**: Visit `/admin/blog/delete/{id}` and confirm delete flow and confirmation UI.
5. **Categories**: Visit `/admin/blog/categories` to create, edit, and delete categories.
6. **Tags**: Visit `/admin/blog/tags` to create, edit, and delete tags.
7. **Featured Image Upload**: Attach a valid image to a post and confirm it is stored under `data/blog/` and displayed in the editor.
