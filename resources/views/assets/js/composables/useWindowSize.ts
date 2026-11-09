/**
 * Composable for getting window size
 *
 * @returns An object containing the current window width and height
 *
 * @example
 * ```ts
 * const { width, height } = useWindowSize();
 * console.log(`Width: ${width}, Height: ${height}`);
 * ```
 */

import { ref, onMounted, onUnmounted } from "vue";

export function useWindowSize() {
  const width = ref(window.innerWidth);
  const height = ref(window.innerHeight);

  const updateSize = () => {
    width.value = window.innerWidth;
    height.value = window.innerHeight;
  };

  onMounted(() => {
    window.addEventListener("resize", updateSize);
  });

  onUnmounted(() => {
    window.removeEventListener("resize", updateSize);
  });

  return { width, height };
}
