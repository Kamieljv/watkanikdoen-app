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

import { inject } from "vue";

export function useTranslate(): (
  key: string,
  params?: Record<string, any>,
) => string {
  const translate = inject<
    (key: string, params?: Record<string, any>) => string
  >("translate", (key: string) => key);
  return translate;
}
