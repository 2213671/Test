package com.example.pos_hcsdl.controller;

import com.example.pos_hcsdl.dto.MenuRequest;
import com.example.pos_hcsdl.dto.MenuResponse;
import com.example.pos_hcsdl.service.MenuService;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Tag(name = "4. Menu Management")
@RestController
@RequestMapping("/menu")
public class MenuController {

    @Autowired
    private MenuService menuService;

    @PostMapping("/create-menu")
    public MenuResponse createMenu(
            @RequestBody MenuRequest menuRequest,
            @RequestHeader(name = "X-Restaurant-Id", required = true) String restaurantId
    ) {
        return menuService.createMenu(menuRequest,restaurantId);
    }

    @GetMapping("/{id}")
    public MenuResponse getMenuById(@PathVariable String id) {
        return menuService.getMenuById(id);
    }

    @GetMapping("/restaurant/{id}")
    public List<MenuResponse> getMenusByRestaurant(@PathVariable String id) {
        return menuService.getMenusByRestaurant(id);
    }

    @PutMapping("/{id}")
    public MenuResponse updateMenuById(@PathVariable String id, @RequestBody MenuRequest menuRequest) {
        return menuService.updateMenu(id,menuRequest);
    }

}
