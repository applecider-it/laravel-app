import axios from "axios";

/**
 * APIのhttp関連
 */

/** JSON通信用のヘッダー */
function jsonRequestHeaders() {
  const headers = {
    Accept: "application/json",
    "Content-Type": "application/json",
  };

  return headers;
}

/**
 * API送信
 *
 * ```
 * options:
 * multipart: trueの場合は、マルチパート指定
 * ```
 */
export async function sendApi(
  method: string,
  url: string,
  data: any = {},
  options: any = {},
) {
  const headers = jsonRequestHeaders();

  // マルチパート指定の時はContent-Typeを変更
  if ("multipart" in options && options.multipart)
    headers["Content-Type"] = "multipart/form-data";

  console.log("sendApi", { method, url, data, options, headers });

  if (method.toUpperCase() === "POST") {
    const response = await axios.post(url, data, {
      headers: headers,
    });

    return response;
  } else {
    const response = await axios.get(url, {
      params: data,
      headers: headers,
    });

    return response;
  }
}
