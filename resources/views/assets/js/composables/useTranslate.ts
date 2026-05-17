import { inject } from "vue";

/**
 * Composable for accessing the translation function
 *
 * @returns Translation function that takes a key and returns the translated string
 *
 * @example
 * ```ts
 * const __ = useTranslate();
 * const text = __("general.error_loading");
 * ```
 */
export function useTranslate(): (
  key: string,
  params?: Record<string, any>,
) => string {
  const translate = inject<
    (key: string, params?: Record<string, any>) => string
  >("translate", (key: string) => key);
  return translate;
}
